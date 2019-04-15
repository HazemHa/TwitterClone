<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User;
use App\Followers;
class FollowersTest extends TestCase {
 use WithFaker;
/***
A Index test Followers.*
*
@return void 
 */
 public function testIndexFollowers() {

 $response = $this->get('/Followers');
 $response->assertOk();
}
/***
A Show test Followers.*
*
@return void 
 */
 public function testShowFollowers() {
 $record = Followers::inRandomOrder()->first(); 

 $response = $this->get('/Followers/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test Followers.*
*
@return void 
 */
 public function testStoreFollowers() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/Followers', [ 
'user_id'=> $this->faker->name,
'follow_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Destroy test Followers.*
*
@return void 
 */
 public function testDestroyFollowers() {

 $user = User::inRandomOrder()->first(); 
 $record = Followers::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/Followers/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test Followers.*
*
@return void 
 */
 public function testUpdateFollowers() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/Followers/'+$record->id+'', [ 
'user_id'=> $this->faker->name,
'follow_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Create test Followers.*
*
@return void 
 */
 public function testCreateFollowers() {
 $record = Followers::inRandomOrder()->first(); 

 $response = $this->get('/Followers/create');
 $response->assertOk();
}
/***
A Edit test Followers.*
*
@return void 
 */
 public function testEditFollowers() {
 $record = Followers::inRandomOrder()->first(); 

 $response = $this->get('/Followers/'+$record->id+'/edit');
 $response->assertOk();
}

}
