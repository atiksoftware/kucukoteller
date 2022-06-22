<?php

namespace App\Console\Commands;

use App\Models\Faq;
use App\Models\Room;
use App\Models\Zone;
use App\Models\Hotel;
use App\Models\Feature;
use App\Models\Category;
use App\Models\Proposal;
use App\Enums\ProposalType;
use App\Models\Comment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DbBackup extends Command
{
	protected $signature = 'db:backup {method?}';

	protected $description = 'Backup old data from JSON files to DB';

	public function handle()
	{
		$method = $this->argument('method');

		$this->info('Backup started');
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		if ('categories' === $method || null === $method) {
			$this->backupCategories();
		}
		if ('zones' === $method || null === $method) {
			$this->backupZones();
		}
		if ('features' === $method || null === $method) {
			$this->backupFeatures();
		}
		if ('hotels' === $method || null === $method) {
			$this->backupHotels();
		}
		if ('rooms' === $method || null === $method) {
			$this->backupRooms();
		}
		if ('comments' === $method || null === $method) {
			$this->backupComments();
		}
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		return 0;
	}

	private function getOldRows($collection_name)
	{
		return json_decode(file_get_contents(storage_path('mongodb/' . $collection_name . '.json')), true);
	}

	private function getId($_id)
	{
		return hexdec($_id) - 100000000;
	}

	private function getPhone($_phone)
	{
		$_phone = trim($_phone);
		$_phone = str_replace(' ', '', $_phone);
		$_phone = str_replace('-', '', $_phone);
		if (!empty($_phone)) {
			return $_phone;
		}

		return null;
	}

	private function backupCategories(): void
	{
		Category::truncate();

		$rows = $this->getOldRows('categories');

		foreach ($rows as $row) {
			$this->info($row['title']['tr']);
			$record = new Category();
			$record->id = $this->getId($row['_id']);
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
		}
	}

	private function backupZones(): void
	{
		Zone::truncate();
		Proposal::truncate();

		$rows = $this->getOldRows('zones');
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			$this->info($i . '/' . $count . ' ' . $row['title']['tr']);
			$record = new Zone();
			$record->id = $this->getId($row['_id']);
			$record->is_visible = (bool) $row['active'];
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

			if (isset($row['parents'])) {
				if (!empty($row['parents'])) {
					$record->parent_id = $this->getId($row['parents'][0]);
				}
			}
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
				$proposal->title = $data['title'];
				$proposal->slug = $data['slug'];
				$proposal->brief = $data['slogan'];
				$proposal->content = $data['text'];

				if (isset($data['meta']['title'])) {
					$proposal->meta_title = $data['meta']['title'];
				}
				if (isset($data['meta']['description'])) {
					$proposal->meta_description = $data['meta']['description'];
				}
				$proposal->save();
			}

			if (isset($row['faqs'])) {
				foreach ($row['faqs'] as $faq) {
					$faq_record = new Faq();
					$faq_record->question = $faq['question'];
					$faq_record->answer = $faq['answer'];
					$faq_record->save();
					$record->faqs()->attach($faq_record->id);
				}
			}
		}
	}

	private function backupFeatures(): void
	{
		Feature::truncate();

		$rows = $this->getOldRows('features_hotels');
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			$this->info($i . '/' . $count . ' ' . $row['title']['tr']);
			$record = new Feature();
			$record->id = $this->getId($row['_id']);
			$record->name = $row['title'];
			$record->save();
		}
	}

	private function backupHotels(): void
	{
		Hotel::truncate();

		$rows = $this->getOldRows('hotels');
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			$this->info($i . '/' . $count . ' ' . $row['title']['tr']);
			$record = new Hotel();
			$record->id = $this->getId($row['_id']);
			$record->name = $row['title'];
			$record->slug = $row['slug'];
			// $record->brief = $row['slogan'];
			$record->content = $row['text'];

			$record->meta_title = $row['meta']['title'];
			$record->meta_description = $row['meta']['description'];

			if (isset($row['options']['active'])) {
				$record->is_active = (bool) $row['options']['active'] ?? false;
			}
			if (isset($row['options']['primary'])) {
				$record->is_priority = (bool) $row['options']['primary'] ?? false;
			}

			if (isset($row['email'])) {
				$record->email = $row['email'];
			}
			if (isset($row['permissions']['email'])) {
				$record->email_viewable = (bool) $row['permissions']['email'] ?? false;
			}

			if (isset($row['phone'])) {
				$record->phone = $this->getPhone($row['phone']);
			}
			if (isset($row['permissions']['phone'])) {
				$record->phone_viewable = (bool) $row['permissions']['phone'] ?? false;
			}

			if (isset($row['whatsapp'])) {
				$record->whatsapp = $this->getPhone($row['whatsapp']);
			}
			if (isset($row['permissions']['whatsapp'])) {
				$record->whatsapp_viewable = (bool) $row['permissions']['whatsapp'] ?? false;
			}

			if (isset($row['site'])) {
				$record->website = $row['site'] ?? null;
			}
			if (isset($row['permissions']['site'])) {
				$record->website_viewable = (bool) $row['permissions']['site'] ?? false;
			}

			if (isset($row['location'], $row['location']['lat'], $row['location']['lng'])) {
				$record->latitude = (float) str_replace(',', '.', $row['location']['lat']);
				$record->longitude = (float) str_replace(',', '.', $row['location']['lng']);
				$record->location_viewable = isset($row['permissions']['location']) ? (bool) $row['permissions']['location'] : false;
			}

			if (isset($row['season']['start']['m'], $row['season']['start']['d'])) {
				$record->season_start_month = is_numeric($row['season']['start']['m']) ? $row['season']['start']['m'] : 1;
				$record->season_start_day = is_numeric($row['season']['start']['d']) ? $row['season']['start']['d'] : 1;
			}
			if (isset($row['season']['end']['m'], $row['season']['end']['d'])) {
				$record->season_end_month = is_numeric($row['season']['end']['m']) ? $row['season']['end']['m'] : 12;
				$record->season_end_day = is_numeric($row['season']['end']['d']) ? $row['season']['end']['d'] : 31;
			}
			if (1 === $record->season_start_month && 1 === $record->season_start_day && 12 === $record->season_end_month && 31 === $record->season_end_day) {
				$record->season_always = true;
			}

			if (isset($row['kontak_kisi'])) {
				$record->contact_person_name = $row['kontak_kisi'] ?? null;
			}
			if (isset($row['oda_sayisi'])) {
				$record->unit_count = (int) $row['oda_sayisi'] ?? 0;
			}
			if (isset($row['address'])) {
				$record->address = $row['address'] ?? null;
			}

			if (isset($row['direction'])) {
				$record->how_to_go = $row['direction'];
			}
			if (isset($row['doviz'])) {
				$record->currency = $row['doviz'];
			}
			if (isset($row['owner']['name'][app()->getLocale()]) && !empty($row['owner']['name'][app()->getLocale()])) {
				$record->owner_fullname = isset($row['owner']['name'][app()->getLocale()]);
			}
			if (isset($row['owner']['text']) && !empty($row['owner']['text'])) {
				$record->owner_welcome_text = $row['owner']['text'];
			}

			if (isset($row['avarage'])) {
				$record->rating = (float) $row['avarage'];
			}
			if (isset($row['phoneview_count'])) {
				$record->call_count = $row['phoneview_count'];
			}
			if (isset($row['reservation_count'])) {
				$record->reservation_count = $row['reservation_count'];
			}
			if (isset($row['visit'])) {
				$record->view_count = $row['visit'];
			}
			if (isset($row['yorum_sayisi'])) {
				$record->comment_count = $row['yorum_sayisi'];
			}
			if (isset($row['nasilbiryer'])) {
				$record->how_is_there_like = [
					'tr' => $row['nasilbiryer'],
					'en' => isset($row['nasilbiryer_en']) ? $row['nasilbiryer_en'] : null,
				];
			}
			if (isset($row['distance'])) {
				if (isset($row['distance']['sea'])) {
					$record->sea_exists = 1 === (int) $row['distance']['sea']['has'];
					$record->sea_name = $row['distance']['sea']['name'];
					$record->sea_distance = (int) $row['distance']['sea']['distance'];
					$record->sea_distance_unit = strtolower($row['distance']['sea']['type']);
				}
				if (isset($row['distance']['airport'])) {
					$record->airport_exists = 1 === (int) $row['distance']['airport']['has'];
					$record->airport_name = $row['distance']['airport']['name'];
					$record->airport_distance = (int) $row['distance']['airport']['distance'];
					$record->airport_distance_unit = strtolower($row['distance']['airport']['type']);
				}
				if (isset($row['distance']['citycenter'])) {
					$record->citycenter_exists = 1 === (int) $row['distance']['citycenter']['has'];
					$record->citycenter_name = $row['distance']['citycenter']['name'];
					$record->citycenter_distance = (int) $row['distance']['citycenter']['distance'];
					$record->citycenter_distance_unit = strtolower($row['distance']['citycenter']['type']);
				}
			}

			$timestamp = $row['date']['edit'];
			$record->created_at = \Carbon\Carbon::createFromTimestamp($timestamp);
			$record->updated_at = \Carbon\Carbon::createFromTimestamp($timestamp);

			$record->save();

			$category_ids = [];
			if (isset($row['categories']) && \is_array($row['categories'])) {
				foreach ($row['categories'] as $category_id) {
					$category_ids[] = $this->getId($category_id);
				}
			}
			$record->categories()->sync($category_ids);

			$zone_ids = [];
			if (isset($row['zones']) && \is_array($row['zones'])) {
				foreach ($row['zones'] as $zone_id) {
					$zone_ids[] = $this->getId($zone_id);
				}
			}
			$record->zones()->sync($zone_ids);
			if (\count($zone_ids) > 0) {
				$record->zone_id = $zone_ids[0];
				$record->save();
			}

			$feature_ids = [];
			if (isset($row['features']) && \is_array($row['features'])) {
				foreach ($row['features'] as $feature_id) {
					$feature_ids[] = $this->getId($feature_id);
				}
			}
			$record->features()->sync($feature_ids);

			if (isset($row['faqs'])) {
				foreach ($row['faqs'] as $faq) {
					$faq_record = new Faq();
					$faq_record->question = $faq['question'];
					$faq_record->answer = $faq['answer'];
					$faq_record->save();
					$record->faqs()->attach($faq_record->id);
				}
			}
		}
	}

	private function backupRooms(): void
	{
		Room::truncate();

		$rows = $this->getOldRows('rooms');
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			$this->info($i . '/' . $count);
			$record = new Room();
			$record->id = $this->getId($row['_id']);
			if (isset($row['name'])) {
				$record->name = $row['name'];
			}
			if (isset($row['title'])) {
				$record->name = $row['title'];
			}

			$record->bed_type_id = (int) $row['bed'];
			$record->size = (int) $row['m'];

			if (is_numeric($row['capacity'])) {
				$record->capacity = $row['capacity'];
			} else {
				$record->description = $row['capacity'];
			}

			$record->children_allowed = (bool) $row['child'];
			$record->hotel_id = $this->getId($row['id_hotel']);
			$record->save();
		}
	}

	private function backupComments(): void
	{
		Comment::truncate();

		$rows = $this->getOldRows('yorumlar');
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			$this->info($i . '/' . $count);
			$this->info($row['owner']['name'] . ' ' . $row['owner']['mail']);
			$record = new Comment();
			$record->id = $this->getId($row['_id']);

			if (isset($row['owner']['name'])) {
				$fullname = $row['owner']['name'];
				if (\strlen($fullname) < 3 || \strlen($fullname) > 20) {
					$fullname = 'Misafir';
				}
				$record->fullname = $fullname;
			} else {
				$record->fullname = 'Misafir';
			}
			if (isset($row['owner']['mail'])) {
				$record->email = $row['owner']['mail'];
			}
			if (isset($row['comment']['text'])) {
				$text = $row['comment']['text'];
				$text = strip_tags($text);
				$text = str_replace('&nbsp;', ' ', $text);
				$text = str_replace('&amp;', '&', $text);
				$text = str_replace('&quot;', '"', $text);
				$text = str_replace("\r", '', $text);
				$text = str_replace("\n", '', $text);
				$record->comment_content = $text;
			}
			if (isset($row['comment']['answer'])) {
				$answer = $row['comment']['answer'];
				$answer = strip_tags($answer);
				$answer = str_replace('&nbsp;', ' ', $answer);
				$answer = str_replace('&amp;', '&', $answer);
				$answer = str_replace('&quot;', '"', $answer);
				$answer = str_replace("\r", '', $answer);
				$answer = str_replace("\n", '', $answer);
				$answer = trim($answer);
				$record->answer_content = $answer;
			}
			if (isset($row['rating'])) {
				$record->rating = $row['rating'];
			}
			if (isset($row['rating'])) {
				if (\is_array($row['rating'])) {
					$values = array_values($row['rating']);
					$record->rating = (int) (array_sum($values) / \count($values));
				} else {
					$record->rating = $row['rating'];
				}
			}
			if (isset($row['date']['edit'])) {
				$timestamp = $row['date']['edit'];
				$record->created_at = \Carbon\Carbon::createFromTimestamp($timestamp);
				$record->updated_at = \Carbon\Carbon::createFromTimestamp($timestamp);
			}
			$record->hotel_id = $this->getId($row['id_hotel']);
			$record->is_active = isset($row['status']) && 1 === (int) $row['status'];
			$record->save();
		}
	}
}
