<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'timezone' => $faker->timezone,
    ];
});
$factory->define(App\Calendar::class, function (Faker\Generator $faker) {
    return [
        'timezone' => $faker->timezone,
        'sync_token' => NULL,
        'title' => 'Primary Calendar',
        'google_calendar_id' => 'primary',
        'user_id' => App\User::all()->random()->id,
    ];
});
$factory->define(App\AppointmentType::class, function (Faker\Generator $faker) {
    $name = $faker->sentence;
    return [
        'name' => $name,
        'description' => $faker->paragraph,
        'hours' => $faker->randomElement($array = array (0,1,2,3)),
        'minutes' => $faker->randomElement($array = array (15,30,45)),
        'user_id' => App\User::all()->random()->id,
        'link' => str_slug(strtolower($name)),
    ];
});
$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
    $start_date = Carbon\Carbon::instance($faker->dateTimeThisYear);
    $end_date = $start_date->copy()->addDays($faker->randomElement($array = array (30,60,90,180,360)));
    return [
        'start_date' => $start_date->toDateString(),
        'end_date' => $end_date->toDateString(),
        'start_time' => $faker->randomElement($array = array ('08:00:00','10:00:00','13:00:00')),
        'end_time' => $faker->randomElement($array = array ('15:00:00','17:00:00')),
        'appointment_type_id' => App\AppointmentType::all()->random()->id,
        'day' => $faker->dayOfWeek(),
    ];
});
$factory->define(App\Appointment::class, function (Faker\Generator $faker) {
    $start = Carbon\Carbon::instance($faker->dateTimeThisMonth);
    $start->minute($faker->randomElement($array = array (0,15,30,45)));
    $start->second = 0;
    $end = $start->copy()->addMinutes($faker->randomElement($array = array (15,30,60,90,180)));
    return [
        'start_at' => $start,
        'end_at' => $end,
        'title' => $faker->sentence,
        'location' => $faker->streetAddress,
        'appointment_type_id' => App\AppointmentType::all()->random()->id,
        'calendar_id' => App\Calendar::all()->random()->id,
    ];
});
$factory->define(App\Invitee::class, function (Faker\Generator $faker) {
    return [
        'display_name' => $faker->name,
        'email' => $faker->email,
        'user_id' => NULL,
        'appointment_id' => App\Appointments::all()->random()->id,
    ];
});