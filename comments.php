<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28-May-17
 * Time: 10:03 PM
 */
require __DIR__.'/vendor/autoload.php';
$fb = new \Facebook\Facebook([
    'app_id' => '131211624097022',
    'app_secret' => 'eacd7c19e81d876af1834b76d1f24ec6',
    'default_graph_version' => 'v2.9',
    'default_access_token' => 'EAAB3VhYZBpP4BABsTUs43TjOCg1ZCOkWtKihZBVm179FOAKNNQnaeP6v8aHNJTpCc4EirpchZA7UkTZAijRuLuL9ZC86Qn4XOSNiVhox1zsVQdoQ5aZCGjLmlHa5KZCYjYhPu2BCUv6JJSRZCVXZBQSU9ONKjrAxBbL7hr3PDbVYrUKeMfqVfEJcEY6pdWeM6B07EZD', // optional
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

try {
    // Get the \Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('me?fields=posts.limit(1){comments}');
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$node = $response->getGraphNode();
//chuyen du lieu response json sang dang mang de xu ly
$ar = $node->asArray();
//vi no co nhieu posts
$posts  = $ar['posts'];

//lay post dau tien, post muon nhat
$post  = $posts[0];
//print_r($post);
//$likes = $post['likes'];
//lay ra toan bo cac comment
$comments = $post['comments'];

//dung ham rsort de liet ke lai cmt theo thu tu thoi gian tu muon nhat
rsort($comments);

//minh chi muon lay ra 2 cmt muon nhat
$last_two_cmt = array();
$last_two_cmt[0] = $comments[0];
$last_two_cmt[1] = $comments[1];
//die(json_encode($last_two_cmt));