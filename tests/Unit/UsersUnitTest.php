<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User;
use App\Users;
class UsersTest extends TestCase {
 use WithFaker;
/***
A Index test Users.*
*
@return void 
 */
 public function testIndexUsers() {

 $response = $this->get('/Users');
 $response->assertOk();
}
/***
A Show test Users.*
*
@return void 
 */
 public function testShowUsers() {
 $record = Users::inRandomOrder()->first(); 

 $response = $this->get('/Users/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test Users.*
*
@return void 
 */
 public function testStoreUsers() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/Users', [ 
'name'=> $this->faker->name,
'username'=> $this->faker->name,
'email'=> $this->faker->name,
'cover'=> $this->faker->name,
'avatar'=> $this->faker->name,
'password'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Destroy test Users.*
*
@return void 
 */
 public function testDestroyUsers() {

 $user = User::inRandomOrder()->first(); 
 $record = Users::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/Users/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test Users.*
*
@return void 
 */
 public function testUpdateUsers() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/Users/'+$record->id+'', [ 
'name'=> $this->faker->name,
'username'=> $this->faker->name,
'email'=> $this->faker->name,
'cover'=> $this->faker->name,
'avatar'=> $this->faker->name,
'password'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Create test Users.*
*
@return void 
 */
 public function testCreateUsers() {
 $record = Users::inRandomOrder()->first(); 

 $response = $this->get('/Users/create');
 $response->assertOk();
}
/***
A Edit test Users.*
*
@return void 
 */
 public function testEditUsers() {
 $record = Users::inRandomOrder()->first(); 

 $response = $this->get('/Users/'+$record->id+'/edit');
 $response->assertOk();
}

}
