<?php

//
// Менеджер пользователей
//
class M_Users extends M_Table
{
    const ADD = 'add';
    const MANAGE_ALL = 'manage_all';

	private static $instance; // экземпляр класса
	//private $userID; // идентификатор текущего пользователя
	//
	// Получение экземпляра класса
	// результат	- экземпляр класса MSQL
	//
	public static function instance($table_name = 'users', $table_key = 'id')
	{
		if (self::$instance == null)
			self::$instance = new self($table_name, $table_key);
			
		return self::$instance;
	}

	//
	// Конструктор
	//
	private function __construct($table_name, $table_key)
	{
        parent::init($table_name, $table_key);

	}

    //проверяем данные пользователя
    public function checkUserCredentials($login, $password){

        $login = trim($login);
        $password = trim($password);

        if (($login == '') || ($password == '')){
            return false;
        }

        // вытаскиваем пользователя из БД
        $user = $this->getByLogin($login);

        //формируем хэш пароля
        $salt = $this->getUserSalt($user['id']);
        $password = sha1($password.$salt);

        if (($user == null) || ($user['password'] != $password)){
            return false;
        }

        return true;
    }

	//
	// Авторизация
	// $login 		- логин
	// $password 	- пароль
	// $remember 	- нужно ли запомнить в куках
	// результат	- описание ошибки (или пусто, если все нормально)
	//
	public function login($login, $password, $remember = true)
	{

		if (!$this->checkUserCredentials($login, $password)){
            return 'Неверный логин или пароль';
        }
				
		// запоминаем имя и (пароль)
		if ($remember)
		{
			$expire = time() + 3600 * 24 * 100;
			setcookie('login', $login, $expire);
			setcookie('password', md5($password), $expire);
		}		
				
		// открываем сессию и запоминаем SID
		//$this->sid = $this->openSession($id_user);
        $_SESSION['login'] = $login;
		return '';
	}

    //
    // пытается залогинить пользователя на основании данных куков
    // возвращает логин текущего пользователя
    //
    public function autoLogin()
    {
        //проверяем не залогинен ли уже пользователь
        if (!isset($_SESSION['login'])){
            //ищем данные пользователя в куках
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])){
                if ($this->checkUserCredentials($_COOKIE['login'], $_COOKIE['password'])){
                    //логиним пользователя
                    $this->login($_COOKIE['login'], $_COOKIE['password']);
                    return $_COOKIE['login'];
                }
            }
        } else {
            return $_SESSION['login'];
        }

        return null;
    }
	
	//
	// Выход
	//
	public function logout()
	{
		setcookie('login', '', time() - 1);
		setcookie('password', '', time() - 1);
		unset($_COOKIE['login']);
		unset($_COOKIE['password']);
		unset($_SESSION['login']);
	}
						
	//
	// Получение пользователя
	// результат - объект пользователя или null
	//
	public function get()
	{
        //ищем пользователя в текущей сессии
        if (isset($_SESSION['login'])){
            return $this->getByLogin($_SESSION['login']);
        } else {
            //ищем данные пользователя в куках
            if (isset($_COOKIE['login']) && isset($_COOKIE['password'])){
                if ($this->checkUserCredentials($_COOKIE['login'], $_COOKIE['password'])){
                    return $this->getByLogin($_COOKIE['login']);
                }
            }
        }

        return null;
	}

    public function getID()
    {
        $current_user = $this->get();
        if ($current_user != null){
            return $current_user['id'];
        }

        return null;
    }

    //регистрация нового пользователя
    //
    public function registration($name, $login, $password, $repeated_password, $role_id = 3)
    {
        $login = trim($login);
        $password = trim($password);
        $repeated_password = trim($repeated_password);

        if (($login == '') || ($password == '') || ($repeated_password == '')){
            return 'Заполнены не все поля.';
        } elseif ($password != $repeated_password) {
            return 'Повторно введенный  пароль не соответствует первоначальному.';
        } elseif ($this->getByLogin($login) != null){
            return 'Пользователь с таким логином уже существует.';
        }


        $salt = $this->getNewSalt();

        $obj = array();
        $obj['name'] = $name;
        $obj['login'] = $login;
        $obj['password'] = sha1($password.$salt);
        $obj['role_id'] = $role_id;

        $user_id = $this->msql->insert($this->table_name, $obj);

        $obj = array();
        $obj['user_id'] = $user_id;
        $obj['salt'] = $salt;

        $this->msql->insert('salts', $obj);

        return '';
    }

	//
	// Получает пользователя по логину
	//
	public function getByLogin($login)
	{	
		$t = "SELECT * FROM users WHERE login = '%s'";
		$query = sprintf($t, $this->msql->makeStringSecure($login));
		$result = $this->msql->select($query);

        return (count($result) == 0) ? null : $result[0];
	}
			
	//
	// Проверка наличия привилегии
	// $priv 		- имя привилегии
	// $id_user		- если не указан, значит, для текущего
	// результат	- true или false
	//
	public function can($priv, $user_id = null)
	{		
		if ($user_id == null)
            $user_id = $this->getID();
		    
		if ($user_id == null)
		    return false;
		    
		$t = "SELECT count(*) as cnt FROM privs2roles p2r
			  LEFT JOIN users u ON u.role_id = p2r.role_id
			  LEFT JOIN privs p ON p.id = p2r.priv_id
			  WHERE u.id = '%d' AND p.name = '%s'";
	
		$query  = sprintf($t, $user_id, $priv);
		$result = $this->msql->select($query);
		if (count($result) > 0){
		    return ($result[0]['cnt'] > 0);
        } else {
            return false;
        }
	}


    private function getNewSalt()
    {
        return $this->generateStr(20);
    }

    private function getUserSalt($user_id)
    {
        $query_text = "SELECT * FROM salts WHERE user_id='$user_id'";
        $data = $this->msql->select($query_text);

        if (count($data) == 0){
            return '';
        }

        return $data[0]['salt'];
    }

	//
	// Генерация случайной последовательности
	// $length 		- ее длина
	// результат	- случайная строка
	//
	private function generateStr($length = 10)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  

		while (strlen($code) < $length) 
            $code .= $chars[mt_rand(0, $clen)];  

		return $code;
	}
}
