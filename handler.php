<?php



function validate(array $request)
{
    $errors = [];

    // if (!isset($request['email']) || strlen($request['email']) == 0) {
    //     $errors[]['email'] = 'Email не указан';
    // } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
    //     $errors[]['email'] = 'Неправильный формат email';
    // } elseif (strlen($request['email']) < 4) {
    //     $errors[]['email'] = 'Email должен быть больше 4х символов';
    // } elseif (isEmailAlreadyExists($request['email'])) {
    //     $errors[]['email'] = 'Email уже используется';
    // }

    // if (!isset($request['name']) || empty($request['name'])) {
    //     $errors[]['name'] = 'Имя не указано';
    // }

    // if (!isset($request['password']) || empty($request['password'])) {
    //     $errors[]['password'] = 'Пароль не указан';
    // }

    // if (!isset($request['repeat-password']) || empty($request['repeat-password'])) {
    //     $errors[]['repeat-password'] = 'Нужно повторить пароль';
    // } elseif ((isset($request['password']) && isset($request['repeat-password'])) && ($request['password'] != $request['repeat-password'])) {
    //     $errors[]['repeat-password'] = 'Пароли не совпадают';
    // }



    // $errors[]['email'] = 'Email не указан';




    return $errors;
}


if (!empty($_POST)) {
    header('Content-Type: application/json');

    $errors = validate($_POST);



    http_response_code(201);
    echo json_encode([
        'success' => true
    ]);
    exit();



    if (empty($errors)) {

        if (register($_POST)) {
            http_response_code(201);
            echo json_encode([
                'success' => true
            ]);
            exit();
        }
        http_response_code(500);
        echo json_encode([
            'success' => false
        ]);
        exit();
    }

    http_response_code(422);

    echo json_encode([
        'success' => false,
        'errors' => $errors
    ]);

    exit();
}