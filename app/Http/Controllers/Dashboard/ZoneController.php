<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\LocaleHelper;
use App\Models\Faq;
use App\Models\Zone;
use App\Models\Proposal;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ZoneController extends Controller
{
	public function index(Request $request)
	{
		$zones = [];

		$search = $request->input('search');

		if (null !== $search) {
			$zones = Zone::where('title', 'like', '%' . $search . '%')
				// ->orderBy('title', 'ASC')
				->paginate(50);
		} else {
			$zones = Zone::where('is_active', true)
				->paginate(12);
		}

		return view('dashboard.zone.list', compact('zones'));
	}

	public function create(Request $request)
	{
		$zone = new Zone();
		$zones = Zone::where('is_active', true)->get();

		return view('dashboard.zone.create', compact('zone', 'zones'));
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|min:3|max:255',
			'title' => 'required|min:3|max:255',
		], [
			'name.required' => __('validation.name.required'),
			'name.string' => __('validation.name.string'),
			'name.min' => __('validation.name.min'),
			'name.max' => __('validation.name.max'),
			'title.required' => __('validation.title.required'),
			'title.string' => __('validation.title.string'),
			'title.min' => __('validation.title.min', ['min' => 3]),
			'title.max' => __('validation.title.max', ['max' => 255]),
		]);

		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		$zone = new Zone();

		$zone->fill($request->all());

		$zone->save();

		ToastHelper::success(__('dashboard.content_created_successfully'));

		return redirect()->route('dashboard.zone.edit', $zone);
	}

	public function edit(Request $request, Zone $zone)
	{
		$zones = Zone::where('is_active', true)->get();

		return view('dashboard.zone.edit', compact('zone', 'zones'));
	}

	public function update(Request $request, Zone $zone)
	{
		$request->validate([
			'title' => 'required|string|max:255',
		], [
			'title.required' => __('validation.title.required'),
			'title.max' => __('validation.title.max', ['max' => 255]),
		]);

		$zone->fill($request->all());

		$zone->save();

		ToastHelper::success(__('dashboard.content_updated_successfully'));

		return redirect()->route('dashboard.zone.edit', $zone);
	}

	public function remove(Request $request, Zone $zone)
	{
		$name = $zone->name;
		$confirm_url = route('dashboard.zone.destroy', $zone);
		$cancel_url = route('dashboard.zone.edit', $zone);

		return view('dashboard.remove', compact('name', 'confirm_url', 'cancel_url'));
	}

	public function destroy(Request $request, Zone $zone)
	{
		$zone->delete();

		ToastHelper::success(__('dashboard.content_removed_successfully'));

		return redirect()->route('dashboard.zone.index');
	}

	public function proposal_edit(Request $request, Proposal $proposal)
	{
		return view('dashboard.zone.proposal', compact('proposal'));
	}

	public function proposal_update(Request $request, Proposal $proposal)
	{
		return view('dashboard.zone.proposal', compact('proposal'));
	}

	public function faq_edit(Request $request, Zone $zone)
	{
		return view('dashboard.zone.faq', compact('zone'));
	}

	public function faq_update(Request $request, Zone $zone)
	{
		$faqs = $zone->faqs();
		$zone->faqs()->detach();
		$faqs->delete();

		$lines = $request->input('lines');
		if (empty($lines)) {
			return redirect()->route('dashboard.zone.faq.edit', $zone);
		}
		// 'question', 'answer'
		foreach ($lines as $line) {
			$faq = new Faq();
			foreach (LocaleHelper::getLocaleCodes() as $locale_code) {
				if (isset($line['question'][$locale_code])) {
					$faq->setTranslation('question', $locale_code, $line['question'][$locale_code]);
				}
				if (isset($line['answer'][$locale_code])) {
					$faq->setTranslation('answer', $locale_code, $line['answer'][$locale_code]);
				}
			}
			$zone->faqs()->save($faq);
		}

		return redirect()->route('dashboard.zone.faq.edit', $zone);
	}
}
