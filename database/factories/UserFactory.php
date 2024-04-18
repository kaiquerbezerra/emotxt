<?php

namespace Database\Factories;

use Andersonhsilva\MetodosPhp\Metodos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $validStates = ['AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];
        return [
            'name' => $this->faker->name(),
            'responsible_id' => $this->faker->randomElement(User::pluck('id')),
            'password' => Hash::make($this->faker->password),
            'cpf' => Metodos::cpfRandom(),
            'cep' => $this->faker->postcode(),
            'address' => $this->faker->text(50),
            'number' => $this->faker->buildingNumber(),
            'district' => $this->faker->citySuffix(),
            'complement' => $this->faker->secondaryAddress(),
            'reference' => $this->faker->word(),
            'city' => $this->faker->city(),
            'state' => $this->faker->randomElement($validStates),
            'birth_date' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'marital_status' => $this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed', 'Stable Union', 'Other']),
            'email' => $this->faker->unique()->safeEmail(),
            'occupation' => $this->faker->word(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
