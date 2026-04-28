<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::query()->orderBy('id')->get();
        if ($properties->isEmpty()) {
            return;
        }

        $count = 0;
        foreach ($properties as $p) {
            $roomTypes = RoomType::query()->where('property_id', $p->id)->orderBy('id')->get();
            if ($roomTypes->isEmpty()) {
                continue;
            }

            foreach ($roomTypes as $idx => $rt) {
                if ($count >= 10) {
                    break 2;
                }

                $roomNumber = (string) (100 + $p->id * 10 + $idx + 1);

                Room::query()->updateOrCreate(
                    ['property_id' => $p->id, 'room_number' => $roomNumber],
                    [
                        'room_type_id' => $rt->id,
                        'name' => $rt->name.' '.$roomNumber,
                        'floor' => (string) (intdiv((int) $roomNumber, 100) ?: 1),
                        'status' => 'active',
                    ]
                );

                $count++;
            }
        }
    }
}

