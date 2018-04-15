<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\StoryModel;
use App\ProfileModel;
use App\TagModel;
use App\FollowModel;
use App\BookmarkModel;
use App\CategoryModel;

class MainController extends Controller
{
    function index()
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $profile = FollowModel::GetAllFollowing($id);
        $timelinesStory = StoryModel::TimelinesStory(8, $profile);
        $topStory = StoryModel::TopStory(2, 0);
        $topAllStory = StoryModel::TopStory(4, 2);
        $newStory = StoryModel::AllStory(8, 0);
        $featuredStory = StoryModel::AllStory(20, 0);
        $popularStory = StoryModel::PopularStory(8, 0);
        $trendingStory = StoryModel::MostViewsStory(8, 0);
        return view('home.index', [
            'title' => 'Official Site',
            'path' => 'home',
            'topStory' => $topStory,
            'topAllStory' => $topAllStory,
            'timelinesStory' => $timelinesStory,
            'newStory' => $newStory,
            'featuredStory' => $featuredStory,
            'popularStory' => $popularStory,
            'trendingStory' => $trendingStory
        ]);
    }
    function collections()
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagAllStory(20);
        $topTags = TagModel::TopTags();
        $allTags = TagModel::AllTags();
        $topUsers = ProfileModel::TopUsers($id, 7);
        return view('collections.index', [
            'title' => 'Collections',
            'path' => 'collections',
            'topStory' => $topStory,
            'topTags' => $topTags,
            'allTags' => $allTags,
            'topUsers' => $topUsers
        ]);
    }
    function collectionsId($ctr)
    {
        return view('others.index', ['title' => 'Collections', 'path' => 'collections']);
    }
    function tagsId($ctr)
    {
        $topStory = StoryModel::PagTagStory($ctr, 12);
        return view('others.index', [
            'title' => 'Tags '.$ctr,
            'path' => 'none',
            'topStory' => $topStory
        ]);
    }
    function ctrId($ctr)
    {
        $topStory = StoryModel::PagCtrStory($ctr, 12);
        return view('others.index', [
            'title' => 'Tags '.$ctr,
            'path' => 'none',
            'topStory' => $topStory
        ]);
    }
    function timelines()
    {
        $id = Auth::id();
        $profile = FollowModel::GetAllFollowing($id);
        $topStory = StoryModel::PagTimelinesStory(20, $profile);
        return view('others.index', [
            'title' => 'Timelines',
            'path' => 'timelines',
            'topStory' => $topStory
        ]);
    }
    function popular()
    {
        $topStory = StoryModel::PagPopularStory(20);
        return view('others.index', [
            'title' => 'Popular',
            'path' => 'popular',
            'topStory' => $topStory
        ]);
    }
    function compose()
    {
        $ctr = CategoryModel::GetCtr();
        return view('compose.index', ['title' => 'New Story', 'path' => 'compose', 'ctr' => $ctr]);
    }
    function fresh()
    {
        $topStory = StoryModel::PagAllStory(20);
        return view('others.index', [
            'title' => 'Fresh',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        $topStory = StoryModel::PagTrendingStory(20);
        return view('others.index', [
            'title' => 'Trending',
            'path' => 'trending',
            'topStory' => $topStory
        ]);
    }
    function search($ctr)
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagSearchStory($ctr, 12);
        $topUsers = ProfileModel::SearchUsers($ctr, $id);
        $topTags = TagModel::SearchTags($ctr);
        return view('search.index', [
            'title' => $ctr,
            'path' => 'home-search',
            'topStory' => $topStory,
            'topUsers' => $topUsers,
            'topTags' => $topTags
        ]);
    }
    function login()
    {
        return view('sign.in', ['title' => 'Login', 'path' => 'none']);
    }
    function signup()
    {
        return view('sign.up', ['title' => 'Signup', 'path' => 'none']);
    }
}
