<?php
namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User;
use App\Profiles;
class ProfilesTest extends TestCase {
 use WithFaker;
/***
A Index test Profiles.*
*
@return void 
 */
 public function testIndexProfiles() {

 $response = $this->get('/Profiles');
 $response->assertOk();
}
/***
A Show test Profiles.*
*
@return void 
 */
 public function testShowProfiles() {
 $record = Profiles::inRandomOrder()->first(); 

 $response = $this->get('/Profiles/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test Profiles.*
*
@return void 
 */
 public function testStoreProfiles() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/Profiles', [ 
'bio'=> $this->faker->name,
'designation'=> $this->faker->name,
'company'=> $this->faker->name,
'city'=> $this->faker->name,
'country'=> $this->faker->name,
'dob'=> $this->faker->name,
'user_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Destroy test Profiles.*
*
@return void 
 */
 public function testDestroyProfiles() {

 $user = User::inRandomOrder()->first(); 
 $record = Profiles::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/Profiles/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test Profiles.*
*
@return void 
 */
 public function testUpdateProfiles() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/Profiles/'+$record->id+'', [ 
'bio'=> $this->faker->name,
'designation'=> $this->faker->name,
'company'=> $this->faker->name,
'city'=> $this->faker->name,
'country'=> $this->faker->name,
'dob'=> $this->faker->name,
'user_id'=> $this->faker->name

 ]); 
 $response->assertOk(); 
}
/***
A Create test Profiles.*
*
@return void 
 */
 public function testCreateProfiles() {
 $record = Profiles::inRandomOrder()->first(); 

 $response = $this->get('/Profiles/create');
 $response->assertOk();
}
/***
A Edit test Profiles.*
*
@return void 
 */
 public function testEditProfiles() {
 $record = Profiles::inRandomOrder()->first(); 

 $response = $this->get('/Profiles/'+$record->id+'/edit');
 $response->assertOk();
}

}
