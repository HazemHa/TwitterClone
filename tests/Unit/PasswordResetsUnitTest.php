<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User;
use App\PasswordResets;
class PasswordResetsTest extends TestCase {
 use WithFaker;
/***
A Index test PasswordResets.*
*
@return void 
 */
 public function testIndexPasswordResets() {

 $response = $this->get('/PasswordResets');
 $response->assertOk();
}
/***
A Show test PasswordResets.*
*
@return void 
 */
 public function testShowPasswordResets() {
 $record = PasswordResets::inRandomOrder()->first(); 

 $response = $this->get('/PasswordResets/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test PasswordResets.*
*
@return void 
 */
 public function testStorePasswordResets() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/PasswordResets', [ 
'email'=> $this->faker->name,
'token'=> $this->faker->name,
'created_at'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Destroy test PasswordResets.*
*
@return void 
 */
 public function testDestroyPasswordResets() {

 $user = User::inRandomOrder()->first(); 
 $record = PasswordResets::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/PasswordResets/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test PasswordResets.*
*
@return void 
 */
 public function testUpdatePasswordResets() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/PasswordResets/'+$record->id+'', [ 
'email'=> $this->faker->name,
'token'=> $this->faker->name,
'created_at'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Create test PasswordResets.*
*
@return void 
 */
 public function testCreatePasswordResets() {
 $record = PasswordResets::inRandomOrder()->first(); 

 $response = $this->get('/PasswordResets/create');
 $response->assertOk();
}
/***
A Edit test PasswordResets.*
*
@return void 
 */
 public function testEditPasswordResets() {
 $record = PasswordResets::inRandomOrder()->first(); 

 $response = $this->get('/PasswordResets/'+$record->id+'/edit');
 $response->assertOk();
}

}
