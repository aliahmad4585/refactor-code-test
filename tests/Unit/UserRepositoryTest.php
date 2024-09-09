<?php

namespace Tests\App\Repository;


class UserRepositoryTest extends TestCase
{

    protected $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository(new User());
    }

    public function testCreateOrUpdateNewUser()
    {
        $request = [
            'role' => env('CUSTOMER_ROLE_ID'),
            'name' => 'Test User',
            'company_id' => '',
            'department_id' => '',
            'email' => 'test@example.com',
            'dob_or_orgid' => '1990-01-01',
            'phone' => '1234567890',
            'mobile' => '0987654321',
            'password' => 'password',
            'consumer_type' => 'paid',
            'customer_type' => 'regular',
            'username' => 'testuser',
            'post_code' => '12345',
            'address' => '123 Test St',
            'city' => 'Test City',
            'town' => 'Test Town',
            'country' => 'Test Country',
            'reference' => 'yes',
            'additional_info' => 'Additional info',
            'cost_place' => 'Cost place',
            'fee' => 'Fee',
            'time_to_charge' => 'Time to charge',
            'time_to_pay' => 'Time to pay',
            'charge_ob' => 'Charge OB',
            'customer_id' => 'Customer ID',
            'charge_km' => 'Charge KM',
            'maximum_km' => 'Maximum KM',
            'translator_ex' => [],
            'user_language' => [],
            'user_towns_projects' => [],
            'status' => '1'
        ];

        $user = $this->userRepository->createOrUpdate(null, $request);

        $this->assertNotNull($user);
        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertEquals('1234567890', $user->phone);
        $this->assertEquals('0987654321', $user->mobile);
        $this->assertEquals('1', $user->status);

        $userMeta = UserMeta::where('user_id', $user->id)->first();
        $this->assertNotNull($userMeta);
        $this->assertEquals('paid', $userMeta->consumer_type);
        $this->assertEquals('regular', $userMeta->customer_type);
        $this->assertEquals('testuser', $userMeta->username);
    }

    public function testCreateOrUpdateExistingUser()
    {
        $existingUser = User::factory()->create();

        $request = [
            'role' => env('CUSTOMER_ROLE_ID'),
            'name' => 'Updated User',
            'company_id' => '',
            'department_id' => '',
            'email' => 'updated@example.com',
            'dob_or_orgid' => '1990-01-01',
            'phone' => '1234567890',
            'mobile' => '0987654321',
            'password' => 'newpassword',
            'consumer_type' => 'paid',
            'customer_type' => 'regular',
            'username' => 'updateduser',
            'post_code' => '12345',
            'address' => '123 Updated St',
            'city' => 'Updated City',
            'town' => 'Updated Town',
            'country' => 'Updated Country',
            'reference' => 'yes',
            'additional_info' => 'Updated info',
            'cost_place' => 'Updated cost place',
            'fee' => 'Updated fee',
            'time_to_charge' => 'Updated time to charge',
            'time_to_pay' => 'Updated time to pay',
            'charge_ob' => 'Updated charge OB',
            'customer_id' => 'Updated Customer ID',
            'charge_km' => 'Updated Charge KM',
            'maximum_km' => 'Updated Maximum KM',
            'translator_ex' => [],
            'user_language' => [],
            'user_towns_projects' => [],
            'status' => '1'
        ];

        $user = $this->userRepository->createOrUpdate($existingUser->id, $request);

        $this->assertNotNull($user);
        $this->assertEquals('Updated User', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
        $this->assertEquals('1234567890', $user->phone);
        $this->assertEquals('0987654321', $user->mobile);
        $this->assertEquals('1', $user->status);

        $userMeta = UserMeta::where('user_id', $user->id)->first();
        $this->assertNotNull($userMeta);
        $this->assertEquals('paid', $userMeta->consumer_type);
        $this->assertEquals('regular', $userMeta->customer_type);
        $this->assertEquals('updateduser', $userMeta->username);
    }
}