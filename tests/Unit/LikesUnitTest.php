<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User;
use App\Likes;
class LikesTest extends TestCase {
 use WithFaker;
/***
A Index test Likes.*
*
@return void 
 */
 public function testIndexLikes() {

 $response = $this->get('/Likes');
 $response->assertOk();
}
/***
A Show test Likes.*
*
@return void 
 */
 public function testShowLikes() {
 $record = Likes::inRandomOrder()->first(); 

 $response = $this->get('/Likes/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test Likes.*
*
@return void 
 */
 public function testStoreLikes() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/Likes', [ 
'user_id'=> $this->faker->name,
'tweet_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Destroy test Likes.*
*
@return void 
 */
 public function testDestroyLikes() {

 $user = User::inRandomOrder()->first(); 
 $record = Likes::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/Likes/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test Likes.*
*
@return void 
 */
 public function testUpdateLikes() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/Likes/'+$record->id+'', [ 
'user_id'=> $this->faker->name,
'tweet_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Create test Likes.*
*
@return void 
 */
 public function testCreateLikes() {
 $record = Likes::inRandomOrder()->first(); 

 $response = $this->get('/Likes/create');
 $response->assertOk();
}
/***
A Edit test Likes.*
*
@return void 
 */
 public function testEditLikes() {
 $record = Likes::inRandomOrder()->first(); 

 $response = $this->get('/Likes/'+$record->id+'/edit');
 $response->assertOk();
}

}
