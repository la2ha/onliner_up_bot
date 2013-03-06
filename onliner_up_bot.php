<?
/**
 * Onliner Up Bot
 *
 * @package  Onliner Up Bot
 * @author   La2ha  <la2ha@la2ha.com>
 * @license  http://www.opensource.org/licenses/mit MIT License
 * @link     http://la2ha.ru (for donate:), https://github.com/la2ha
 */
require_once 'settings.php';
require_once 'curl/curl.php';
require_once 'simple_html_dom.php';
$curl = new Curl;
$curl->referer = 'http://onliner.by';
$curl->user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:19.0) Gecko/20100101 Firefox/19.0';
//x и y - хз что это, у меня браузер их отправлял, поэтому тут тоже наверно улчше отправить
$curl->post('https://profile.onliner.by/login', $vars = array('username' => $settings['username'], 'password' => $settings['password'], 'x' => 163, 'y' => 22));
$response = $curl->get($settings['my_items_url']);
$html = new Simple_html_dom();
$html->load($response->body);
$uppers = $html->find('a.btn-up');
$curl->referer = $settings['my_items_url'];
$curl->follow_redirects = false;
foreach ($uppers as $upper)
    $response = $curl->get('http://baraholka.onliner.by' . $upper->href, $vars = array());


