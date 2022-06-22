<?php

namespace App\Observers;

use App\Models\Zone;
use App\Models\Proposal;
use App\Enums\ProposalType;
use App\Helpers\MetaHelper;
use Illuminate\Support\Str;

class ZoneObserver
{
	public function saving(Zone $zone): void
	{
		if (empty($zone->slug)) {
			$zone->slug = Str::slug($zone->name);
		}
		if (empty($zone->meta_title)) {
			$zone->meta_title = $zone->title;
		}
		if (empty($zone->meta_description)) {
			$zone->meta_description = MetaHelper::getFirstSentence($zone->brief);
		}
	}

	public function created(Zone $zone): void
	{
		$proposal_types = ProposalType::cases();
		foreach ($proposal_types as $proposal_type) {
			$proposal = new Proposal();
			$proposal->type = $proposal_type;
			$proposal->zone_id = $zone->id;
			$proposal->save();
		}
	}
}
