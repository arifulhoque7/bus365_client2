<?php

$routes->group('modules/backend/websettings', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers"], function ($routes) {
    $routes->get('new', 'Websetting::new', ['as' => 'new-websetting']);
    $routes->post('', 'Websetting::create', ['as' => 'create-websetting']);
    $routes->get('', 'Websetting::index', ['as' => 'index-websetting']);
    $routes->get('(:segment)/edit', 'Websetting::edit/$1', ['as' => 'edit-websetting']);
    $routes->put('(:segment)', 'Websetting::update/$1', ['as' => 'update-websetting']);

    $routes->get('factory-reset', 'Websetting::factoryReset', ['as' => 'factory-reset']);
    $routes->post('factory-reset', 'Websetting::processFactoryReset', ['as' => 'process-factory-reset']);
    $routes->get('db/backup', 'Websetting::dataBaseBackUp', ['as' => 'backupdb-websetting']);
});

$routes->group('modules/backend/emailsettings', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers"], function ($routes) {
    $routes->get('new', 'Email::new', ['as' => 'new-email']);
    $routes->post('', 'Email::create', ['as' => 'create-email']);
    $routes->get('(:segment)/edit', 'Email::edit/$1', ['as' => 'edit-email']);
    $routes->put('(:segment)', 'Email::update/$1', ['as' => 'update-email']);

    $routes->get('', 'Email::subscribeIndex', ['as' => 'index-subscribe']);
    $routes->delete('(:segment)', 'Email::subscribedelete/$1', ['as' => 'delete-subscribe']);
});
$routes->group('modules/backend/smssettings', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers"], function ($routes) {
    $routes->get('new', 'Sms::new', ['as' => 'new-sms']);
    $routes->post('', 'Sms::create', ['as' => 'create-sms']);
    $routes->get('(:segment)/edit', 'Sms::edit/$1', ['as' => 'edit-sms']);
    $routes->put('(:segment)', 'Sms::update/$1', ['as' => 'update-sms']);
    $routes->delete('(:segment)', 'Sms::delete/$1', ['as' => 'delete-sms']);
});

$routes->group('modules/backend/smstemplate', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers"], function ($routes) {
    $routes->get('new', 'SmsTemplate::new',['as' => 'new-smstemplate']);
    $routes->post('', 'SmsTemplate::create',['as' => 'create-smstemplate']);
    $routes->get('', 'SmsTemplate::index',['as' => 'index-smstemplate']);
    $routes->get('(:segment)/edit', 'SmsTemplate::edit/$1',['as' => 'edit-smstemplate']);
    $routes->put('(:segment)', 'SmsTemplate::update/$1',['as' => 'update-smstemplate']);
    $routes->delete('(:segment)', 'SmsTemplate::delete/$1',['as' => 'delete-smstemplate']);
    $routes->get('send_sms_view', 'SmsTemplate::send_sms_view',['as' => 'send-sms-view-smstemplate']);
    $routes->post('send_sms', 'SmsTemplate::sms_send',['as' => 'send-sms-smstemplate']);
});

$routes->group('modules/backend/socialmedias', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers"], function ($routes) {
    $routes->get('new', 'Socialmedia::new', ['as' => 'new-socialmedia']);
    $routes->post('', 'Socialmedia::create', ['as' => 'create-socialmedia']);
    $routes->get('', 'Socialmedia::index', ['as' => 'index-socialmedia']);
    $routes->get('(:segment)/edit', 'Socialmedia::edit/$1', ['as' => 'edit-socialmedia']);
    $routes->put('(:segment)', 'Socialmedia::update/$1', ['as' => 'update-socialmedia']);
    $routes->delete('(:segment)', 'Socialmedia::delete/$1', ['as' => 'delete-socialmedia']);
});

$routes->group('modules/backend/footers', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers"], function ($routes) {
    $routes->get('new', 'Footer::new', ['as' => 'new-footer']);
    $routes->post('', 'Footer::create', ['as' => 'create-footer']);
    $routes->get('', 'Footer::index', ['as' => 'index-footer']);
    $routes->get('(:segment)/edit', 'Footer::edit/$1', ['as' => 'edit-footer']);
    $routes->put('(:segment)', 'Footer::update/$1', ['as' => 'update-footer']);
});

$routes->group('modules/api/v1/website/seetings', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers\Api"], function ($routes) {
    $routes->get('', 'Websetting::index');
    $routes->get('social/media', 'Socialmedia::index');
    $routes->get('footer/content', 'Footer::index');
});

$routes->group('modules/api/v1/website/emails', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers\Api"], function ($routes) {
    $routes->post('subscrib', 'Email::suibscrib');
    $routes->post('check/email/pass', 'Email::chekckEmailForgetPass');
    $routes->post('reset/pass', 'Email::confirmResetPassword');
});

$routes->group('modules/api/v1/website/sms', ["filter" => "cors", "namespace" => "\Modules\Website\Controllers\Api"], function ($routes) {
    $routes->post('send_sms', 'Sms::send_sms');
});
