<?php

namespace App\Observers;

use App\Models\Proposal;
use App\Helpers\MetaHelper;
use Illuminate\Support\Str;
use App\Helpers\ProposalHelper;

class ProposalObserver
{
	public function saving(Proposal $proposal): void
	{
		$zone = $proposal->zone;

		if (empty($proposal->title)) {
			ProposalHelper::fillTitle($proposal);
		}

		if (empty($proposal->slug)) {
			$proposal->slug = Str::slug($proposal->title);
		}
		if (empty($proposal->meta_title)) {
			$proposal->meta_title = $proposal->title;
		}
		if (empty($proposal->meta_description)) {
			$proposal->meta_description = MetaHelper::getFirstSentence($proposal->brief);
		}
	}
}
