<?php
/*
  MODULO DE INICIO DE SESION SEGURO
  Desarrollado por: Ing. Ernesto Enrique Flames
  Fecha: 10/10/2013
*/


class UserAuthentication
{

  private $_session_namespace = "lacajita"; 
  private $_user_table = "miembro";
  private $_db;

  /* Constantes de clase para crear una conexión por defecto */
  const default_db_user = 'root';
  const default_db_pass = 'password';
  const default_db_name = 'bdcajita';
  const default_db_host = 'mzsi082w7';

  /*
   * Debe recibir una conexión PDO válida o intentará crear una.
   */
  public function __construct($pdoConnection = NULL)
  {
    if(!$pdoConnection)
      $pdoConnection = $this->getConnection();
    $this->_db = $pdoConnection;
  }

  /*
   * Crea una conexión PDO con los datos por default definidos como
   * constantes de clase.
   */
  private function getConnection()
  {
    $dsn = 'mysql:dbname='.self::default_db_name.';host='.self::default_db_host;
    try {
      $dbh = new PDO($dsn, self::default_db_user, self::default_db_pass);
    } catch (PDOException $e) {
      die( 'Connection failed: ' . $e->getMessage() );
    }
    return $dbh;
  }
  
  /*
   * Responde si el usuario activo está autenticado en sesión.
   */
  public function isAuthenticated()
  {
    return $this->getSession('user_authenticated') === true;
  }


  /*
   * Realiza un Login y guarda los datos en sesión.
   */
  public function doLogin($username,$password)
  {
    $result = $this->checkLoginInDB($username,$password);
    if(!$result) {
      $this->doLogout();
      return false;
    }

    $this->setSession('user_authenticated',true);
    $this->setSession('id',$result['id']);

    return true;
  }

// llamo el id del usuario
  public function getUserId()
  {
    return $this->getSession('id');
  }

  /*
   * Quita al usuario de sesión.
   */
  public function doLogout()
  {
    $this->destroySession();
  }

  /*
   * Verifica si el usuario está en la base de datos.
   */
  private function checkLoginInDB($username,$password)
  {
    try {
      $query = 'SELECT id FROM '. $this->_user_table . ' WHERE ';
      $query .= ' usuario = ? AND clave = ? AND elim = 0 ';
      $sth = $this->_db->prepare($query);
      $sth->execute(array($username,$this->encryptPassword($password)));
      return $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die( 'Query failed: ' . $e->getMessage() );
    }
  }
  /*
   * Encripta un password en texto plano.
   */
  private function encryptPassword($password)
  {
    return sha1($password);
  }
  
  private function getSession($key)
  {
    $session = $_SESSION[$this->_session_namespace];
    if(isset($session[$key]))
      return $session[$key];
    return null;
  }
  private function setSession($key,$val)
  {
    return $_SESSION[$this->_session_namespace][$key] = $val;
  }
  private function destroySession()
  {
    $_SESSION[$this->_session_namespace] = null;
    unset($_SESSION[$this->_session_namespace]);
  }

}