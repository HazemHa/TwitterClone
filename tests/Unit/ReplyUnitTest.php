<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User;
use App\Reply;
class ReplyTest extends TestCase {
 use WithFaker;
/***
A Index test Reply.*
*
@return void 
 */
 public function testIndexReply() {

 $response = $this->get('/Reply');
 $response->assertOk();
}
/***
A Show test Reply.*
*
@return void 
 */
 public function testShowReply() {
 $record = Reply::inRandomOrder()->first(); 

 $response = $this->get('/Reply/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test Reply.*
*
@return void 
 */
 public function testStoreReply() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/Reply', [ 
'body'=> $this->faker->name,
'user_id'=> $this->faker->name,
'tweet_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Destroy test Reply.*
*
@return void 
 */
 public function testDestroyReply() {

 $user = User::inRandomOrder()->first(); 
 $record = Reply::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/Reply/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test Reply.*
*
@return void 
 */
 public function testUpdateReply() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/Reply/'+$record->id+'', [ 
'body'=> $this->faker->name,
'user_id'=> $this->faker->name,
'tweet_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Create test Reply.*
*
@return void 
 */
 public function testCreateReply() {
 $record = Reply::inRandomOrder()->first(); 

 $response = $this->get('/Reply/create');
 $response->assertOk();
}
/***
A Edit test Reply.*
*
@return void 
 */
 public function testEditReply() {
 $record = Reply::inRandomOrder()->first(); 

 $response = $this->get('/Reply/'+$record->id+'/edit');
 $response->assertOk();
}

}
