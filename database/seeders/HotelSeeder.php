<?php

namespace Database\Seeders;

use App\Enums\ProposalType;
use App\Models\Proposal;
use App\Models\Zone;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
	public function run(): void
	{
		Zone::truncate();

		$rows = SeederHelper::getRows('zones');

		foreach ($rows as $i => $row) {
			if ($i > 10) {
				break;
			}
			echo $row['name']['tr'] . "\n";
			$record = new Zone();
			$record->name = $row['name'];
			$record->title = $row['title'];
			$record->slug = $row['slug'];
			$record->brief = $row['slogan'];
			$record->content = $row['text'];

			$record->meta_title = $row['meta']['title'];
			$record->meta_description = $row['meta']['description'];

			$timestamp = $row['date']['edit'];
			$record->created_at = \Carbon\Carbon::createFromTimestamp($timestamp);
			$record->updated_at = \Carbon\Carbon::createFromTimestamp($timestamp);
			$record->save();

			foreach ($row['proposals'] as $proposal_key => $data) {
				$proposal_type = ProposalType::DIRECTION;
				switch ($proposal_key) {
					case 'direction':
						$proposal_type = ProposalType::DIRECTION;
						break;
					case 'eat':
						$proposal_type = ProposalType::EAT;
						break;
					case 'guide':
						$proposal_type = ProposalType::GUIDE;
						break;
					case 'places':
						$proposal_type = ProposalType::PLACES;
						break;
					case 'todo':
						$proposal_type = ProposalType::TODO;
						break;
					case 'take':
						$proposal_type = ProposalType::TAKE;
						break;
					case 'butik':
						$proposal_type = ProposalType::BOUTIQUE;
						break;
					case 'price':
						$proposal_type = ProposalType::PRICE;
						break;
				}
				$proposal = Proposal::where('zone_id', $record->id)->where('type', $proposal_type)->first();
				if (!$proposal) {
					$proposal = new Proposal();
					$proposal->zone_id = $record->id;
					$proposal->type = $proposal_type;
					$proposal->save();
				}
				$proposal->title = $row['title'];
				$proposal->slug = $row['slug'];
				$proposal->brief = $row['slogan'];
				$proposal->content = $row['text'];

				$proposal->meta_title = $row['meta']['title'];
				$proposal->meta_description = $row['meta']['description'];
				$proposal->save();
			}
		}
	}
}
