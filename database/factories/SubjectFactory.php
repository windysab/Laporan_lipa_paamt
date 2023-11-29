<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // $table->id();
        //     $table->string('title');
        //     $table->bigInteger('lecturer_id')->unsigned();
        //     //semester
        //     $table->integer('semester');
        //     //tahun akademik
        //     $table->string('academic_year');
        //     //sks
        //     $table->integer('sks');
        //     //kode mata kuliah

        //     $table->string('code');
        //     //deskripsi
        //     $table->text('description');
        //     $table->timestamps();


        //     $table->foreign('lecturer_id', 'lecturerid_foreign')
        return [
            'title' => $this->faker->title(),
            'lecturer_id' => $this->faker->numberBetween(1, 10),
            'semester' => $this->faker->numberBetween(1, 10),
            'academic_year' => '2022/2023',
            'sks' => $this->faker->numberBetween(1, 10),
            'code' => $this->faker->word(),
            'description' => $this->faker->text(),
        ];
    }
}
