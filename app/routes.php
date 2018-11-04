<?php
// Routes

$app->get('/', 'App\Action\PostAction:getPosts');
$app->get('/post/{id}', 'App\Action\PostAction:getPost');
$app->post('/create', 'App\Action\PostAction:createPost');
$app->put('/update/{id}', 'App\Action\PostAction:updatePost');
$app->delete('/delete/{id}', 'App\Action\PostAction:deletePost');