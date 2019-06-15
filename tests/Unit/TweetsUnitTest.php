<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User;
use App\Tweets;
class TweetsTest extends TestCase {
 use WithFaker;
/***
A Index test Tweets.*
*
@return void 
 */
 public function testIndexTweets() {

 $response = $this->get('/Tweets');
 $response->assertOk();
}
/***
A Show test Tweets.*
*
@return void 
 */
 public function testShowTweets() {
 $record = Tweets::inRandomOrder()->first(); 

 $response = $this->get('/Tweets/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test Tweets.*
*
@return void 
 */
 public function testStoreTweets() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/Tweets', [ 
'body'=> $this->faker->name,
'user_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Destroy test Tweets.*
*
@return void 
 */
 public function testDestroyTweets() {

 $user = User::inRandomOrder()->first(); 
 $record = Tweets::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/Tweets/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test Tweets.*
*
@return void 
 */
 public function testUpdateTweets() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/Tweets/'+$record->id+'', [ 
'body'=> $this->faker->name,
'user_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Create test Tweets.*
*
@return void 
 */
 public function testCreateTweets() {
 $record = Tweets::inRandomOrder()->first(); 

 $response = $this->get('/Tweets/create');
 $response->assertOk();
}
/***
A Edit test Tweets.*
*
@return void 
 */
 public function testEditTweets() {
 $record = Tweets::inRandomOrder()->first(); 

 $response = $this->get('/Tweets/'+$record->id+'/edit');
 $response->assertOk();
}

}
