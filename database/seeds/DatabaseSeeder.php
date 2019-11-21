<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Branch;
use App\Models\BranchCaptain;
use App\Models\AgentAddresslist;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\OrderStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);

        $user= User::create([
            'firstname' => str_random(8),
            'lastname' => str_random(8),
            'email' => str_random(12).'@mail.com',
            'password' => bcrypt('123456'),
            'phone' => 1009739491,
            'latitude' => 12.54545454,
            'longitude' => 12.54545454,
            'address' => str_random(8),
            'state_id' => 10,
            'city_id' => 4,
            'status' => 'active',
            'type' => 3,
            'active' => 1,
        ]);
        $token = $user->createToken('Token')->accessToken;
        $branch =Branch::create([
            'name' => str_random(8),
            'email' => str_random(12).'@mail.com',
            'phone' => 1009739491,
            'latitude' => 12.54545454,
            'longitude' => 12.54545454,
            'address' => str_random(8),
            'agent_id' => $user->id,
            'state_id' => 10,
            'city_id' => 4,

        ]);

        $branch_details =BranchCaptain::create([
            'captain_id' => $user->id,
            'branch_id' => $branch->id,
        ]);


        $order = Order::create([
            'end_lang' => 12.54545454,
            'end_lat' => 12.54545454,
            'agent_id' => $user->id,
            'agentaddress_id' =>$branch->id,
            'address' => str_random(8),
            'state_id' => 10,
            'city_id' => 4,
        ]);

        $order_details = OrderDetails::create([
            'order_id' =>$order->id,
            'name' => str_random(8),
            'qty' => 5,
            'amount' => 100,
        ]);

        $order_details = OrderStatus::create([
            'order_id' =>$order->id,
            'captain_id' => $user->id,
        ]);

        $user1= User::create([
            'firstname' => str_random(8),
            'lastname' => str_random(8),
            'email' => 'eslam@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => 1009739491,
            'latitude' => 12.54545454,
            'longitude' => 12.54545454,
            'address' => str_random(8),
            'state_id' => 10,
            'city_id' => 4,
            'status' => 'active',
            'type' => 4,
            'active' => 1,

        ]);
        $user2= User::create([
            'firstname' => str_random(8),
            'lastname' => str_random(8),
            'email' => str_random(12).'@mail.com',
            'password' => bcrypt('123456'),
            'phone' => 1009739491,
            'latitude' => 12.54545454,
            'longitude' => 12.54545454,
            'address' => str_random(8),
            'state_id' => 10,
            'city_id' => 4,
            'status' => 'active',
            'type' => 4,
            'active' => 1,

        ]);
        $token = $user2->createToken('Token')->accessToken;
        $token = $user1->createToken('Token')->accessToken;

        $branch2 =Branch::create([
            'name' => str_random(8),
            'email' => str_random(12).'@mail.com',
            'phone' => 1009739491,
            'latitude' => 12.54545454,
            'longitude' => 12.54545454,
            'address' => str_random(8),
            'agent_id' => $user2->id,
            'state_id' => 10,
            'city_id' => 4,

        ]);

        $branch3 =Branch::create([
            'name' => str_random(8),
            'email' => str_random(12).'@mail.com',
            'phone' => 1009739491,
            'latitude' => 12.54545454,
            'longitude' => 12.54545454,
            'address' => str_random(8),
            'agent_id' => $user1->id,
            'state_id' => 10,
            'city_id' => 4,

        ]);

        $branch_details =BranchCaptain::create([
            'captain_id' => $user2->id,
            'branch_id' => $branch2->id,
        ]);
        $branch_details =BranchCaptain::create([
            'captain_id' => $user1->id,
            'branch_id' => $branch3->id,
        ]);

        $order2 = Order::create([
            'end_lang' => 12.54545454,
            'end_lat' => 12.54545454,
            'agent_id' => $user2->id,
            'agentaddress_id' =>$branch2->id,
            'address' => str_random(8),
            'state_id' => 10,
            'city_id' => 4,
        ]);
        $order1 = Order::create([
            'end_lang' => 12.54545454,
            'end_lat' => 12.54545454,
            'agent_id' => $user1->id,
            'agentaddress_id' =>$branch2->id,
            'address' => str_random(8),
            'state_id' => 10,
            'city_id' => 4,
        ]);
        
        $order_details2 = OrderDetails::create([
            'order_id' =>$order2->id,
            'name' => str_random(8),
            'qty' => 5,
            'amount' => 100,
        ]);
        $order_details1 = OrderDetails::create([
            'order_id' =>$order1->id,
            'name' => str_random(8),
            'qty' => 5,
            'amount' => 100,
        ]);

        $order_details = OrderStatus::create([
            'order_id' =>$order1->id,
            'captain_id' => $user2->id,
        ]);

        $order_details = OrderStatus::create([
            'order_id' =>$order1->id,
            'captain_id' => $user1->id,
        ]);


    }
}
