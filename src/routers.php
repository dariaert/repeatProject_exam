<?php

use controllers\Controller;
use router\Router;

Router::myGet('/','home');
Router::myGet('/login','login');
Router::myGet('/register','register');
Router::myGet('/about.php', 'about');
Router::myGet('/update.php', 'update');
Router::myGet('/admin', 'admin');
Router::myGet('/catalog', 'catalog');

Router::myPost('/add', Controller::class, 'add');
Router::myPost('/delete', Controller::class, 'delete');
Router::myPost('/delete/avatar', Controller::class, 'deleteImage');
Router::myPost('/update/avatar', Controller::class, 'updateImage');
Router::myPost('/redact', Controller::class, 'redact');

Router::myPost('/auth', Controller::class, 'auth');
Router::myPost('/reg', Controller::class, 'reg');
Router::myPost('/logout', Controller::class, 'logout');

Router::getContent();