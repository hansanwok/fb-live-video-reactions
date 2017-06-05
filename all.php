<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28-May-17
 * Time: 11:29 PM
 */
// sau khi lay dc react va comment, minh se cho chung vao 1 mang all, bang ham merge_array
//, key la id(nguoi), va co cac key nhu message,pic,name,react,
// neu nguoi do chi lam 1 trong 2, react or cmt thi cai ko co se de rong
// neu mang do co react t bom vao react,
// neu mang co cmt bom vao cmt,
//nhu v se lay dc pic de cho vao moi cmt
// ca key cua react va cmt ko an khop vs nhau, nen ta se chuyen cmt va dang mang co cau truc giong react trc r ms gop
//cach nay ko an thua vi mang dang chi so 0,1,....

require __DIR__.'/vendor/autoload.php';
$fb = new \Facebook\Facebook([
    'app_id' => '131211624097022',
    'app_secret' => 'eacd7c19e81d876af1834b76d1f24ec6',
    'default_graph_version' => 'v2.9',
    'default_access_token' => 'EAAB3VhYZBpP4BAHzZCq6W4F08CDJ73VbgmAX17nWz0KUcO80dwApGq8NFZCr0NV47Jv5lpFFlc87Q4wAn659Qcw9JDCugXnHScrMDwiB1YC1aZBZC5uzS2HNE5M06M2fOZBUZAban6tL84Tv3tixr9ZCWKzXQdcjBG1BTY96Fez6JoXXA0g1iVvcDZBVr6CUWP1cZD', // optional
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

try {
    // Get the \Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('me?fields=posts.limit(1){comments,reactions{pic_small,name,id,type}}');
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
//vi no la mang cac posts
$posts  = $ar['posts'];

//lay post dau tien, post muon nhat
$post  = $posts[0];
//print_r($post);
//$likes = $post['likes'];
$reactions = $post['reactions'];
$comments = $post['comments'];


//dung ham rsort de liet ke lai cmt theo thu tu thoi gian tu muon nhat
rsort($comments);

//minh chi muon lay ra 2 cmt muon nhat
$last_cmt = array();
$last_cmt = $comments[0];
//dem so luong cmt
$last_cmt['count'] = count($comments);
// them pic cho cmt
$response = $fb->get($last_cmt['from']['id'] . "?fields=picture{url}");
$picture = $response->getGraphNode();
$pic_arr = $picture->asArray();
$last_cmt['pic_small'] = $pic_arr['picture']['url'];

//$last_two_cmt[1] = $comments[1];

die(json_encode(['reactions'=>$reactions,'last_cmt'=>$last_cmt]));
// ben kia se tra ve kieu data.reactions, data.comments