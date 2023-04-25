<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */
echo "<link rel='stylesheet' href='style.css'>";
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();

  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['superpower'] = !empty($_COOKIE['superpower_error']);
  $errors['limbs'] = !empty($_COOKIE['limbs_error']);
  $errors['check'] = !empty($_COOKIE['check_error']);
  $errors['text'] = !empty($_COOKIE['text_error']);
  // TODO: аналогично все поля.

  // Выдаем сообщения об ошибках.
  if ($errors['fio']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('fio_error', '', 100000);
    // Выводим сообщение.
    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  // TODO: тут выдать сообщения об ошибках в других полях.
  if ($errors['email']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('email_error', '', 100000);
      // Выводим сообщение.
      $messages[] = '<div class="error">Заполните email.</div>';
  }
  if ($errors['year']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('year_error', '', 100000);
      // Выводим сообщение.
      $messages[] = '<div class="error">Выберите год.</div>';
  }
  
  if ($errors['gender']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('gender_error', '', 100000);
      // Выводим сообщение.
      $messages[] = '<div class="error">Выберите пол.</div>';
  }
  if ($errors['limbs']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('limbs_error', '', 100000);
      // Выводим сообщение.
      $messages[] = '<div class="error">Выберите конечности.</div>';
  }
  if ($errors['superpower']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('superpower_error', '', 100000);
      // Выводим сообщение.
      $messages[] = '<div class="error">Выберите сверхспособность.</div>';
  }
  if ($errors['text']) {
      // Удаляем куку, указывая время устаревания в прошлом.
      setcookie('text_error', '', 100000);
      // Выводим сообщение.
      $messages[] = '<div class="error">Впишите био.</div>';
  }
  if ($errors['check']) {
      setcookie('check_error', '', 100000);
      $messages[] = '<div class="pas error">Ознакомтесь с контрактом.</div>';
  }
  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['superpower'] = empty($_COOKIE['superpower_value']) ? '' : $_COOKIE['superpower_value'];
  $values['limbs'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
  $values['text'] = empty($_COOKIE['text_value']) ? '' : $_COOKIE['text_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? 0 : $_COOKIE['check_value'];
  
  //print_r($_POST);
  //exit(); 
  // TODO: аналогично все поля.

  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($_POST['fio'])) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    setcookie('fio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на месяц.
    setcookie('fio_value', $_POST['fio'], time() + 30 * 24 * 60 * 60);
  }
  
  $errors = FALSE;
  if (empty($_POST['email'])) {
      // Выдаем куку на день с флажком об ошибке в поле fio.
      setcookie('email_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  }
  else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  }
  
  if (($_POST['year'] < 1922) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
      setcookie('year_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['gender'])) {
      setcookie('gender_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['superpower'])) {
      setcookie('superpower_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('superpower_value', $_POST['superpower'], time() + 30 * 24 * 60 * 60);
  }

  if (empty($_POST['text'])) {
      setcookie('text_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('text_value', $_POST['text'], time() + 30 * 24 * 60 * 60);
  }
  if (empty($_POST['limbs'])) {
      setcookie('limbs_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
  } else {
      // Сохраняем ранее введенное в форму значение на месяц.
      setcookie('limbs_value', $_POST['limbs'], time() + 30 * 24 * 60 * 60);
      //checked( 'limbs_value', $_POST['limbs'], 'limbs_value' );
  }
  if(!isset($_POST['check'])){
      setcookie('check_error','1',time()+  24 * 60 * 60);
      setcookie('check_value', '', 100000);
      $errors=TRUE;
  }
  else{
      setcookie('check_value', TRUE,time()+ 12 * 30 * 24 * 60 * 60);
      setcookie('check_error','',100000);
  }
  
 // $radioButtonValue = isset($_COOKIE['gender_value']) ? $_COOKIE['gender_value'] : '';
// *************
// TODO: тут необходимо проверить правильность заполнения всех остальных полей.
// Сохранить в Cookie признаки ошибок и значения полей.
// *************

  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('fio_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('year_error', '', 100000);
    setcookie('gender_error', '',100000);
    setcookie('limbs_error', '',100000);
    setcookie('superpower_error', '', 100000);
    setcookie('text_error', '', 100000);
    setcookie('check_error', '', 100000);
    // TODO: тут необходимо удалить остальные Cookies.
  }

  // Сохранение в БД.
  $user = 'u52813';
  $pass = '9339974';
  $db = new PDO('mysql:host=localhost;dbname=u52813', $user, $pass, [PDO::ATTR_PERSISTENT => true]);
  
  try{
      $stmt = $db->prepare("REPLACE INTO abilities (id,name_of_ability) VALUES (10, 'Бессмертие'), (20, 'Прохождение сквозь стены'), (30, 'Левитация')");
      $stmt-> execute();
  }
  catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
  }
  // Подготовленный запрос. Не именованные метки.
  try {
      $stmt = $db->prepare("INSERT INTO form SET name = ?, year = ?, email = ?, pol = ?, limbs = ?, bio = ?");
      $stmt -> execute([$_POST['fio'], $_POST['year'], $_POST['email'],$_POST['gender'], $_POST['limbs'], $_POST['text']]);
  }
  catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
  }
  
  $id = $db->lastInsertId();
  
  try{
      $stmt = $db->prepare("REPLACE INTO Super (id_s,name) VALUES (10, 'God'), (20, 'fly'), (30, 'idclip'), (40, 'fireball')");
      $stmt-> execute();
  }
  catch (PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
  }
  
  //print_r($_POST);
  //print_r($id);
  //exit();
  try {
      $stmt = $db->prepare("INSERT INTO Sform SET id_per = ?, id_sup = ?");
      foreach ($_POST['superpower'] as $ability) {
          if ($ability=='t')
          {$stmt -> execute([$id, 10]);}
          else if ($ability=='b')
          {$stmt -> execute([$id, 20]);}
          else if ($ability=='c')
          {$stmt -> execute([$id, 30]);}
          else if ($ability=='p')
          {$stmt -> execute([$id, 30]);}
      }
  }
  catch(PDOException $e) {
      print('Error : ' . $e->getMessage());
      exit();
  }
  

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}
