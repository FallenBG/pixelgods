<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Factory\StoryFactory;

class StoriesTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function a_registered_user_can_create_story()
    {
//        $this->withoutExceptionHandling();

        $story = StoryFactory::ownedBy($this->signIn())->create();

        $this->assertDatabaseHas('stories', ['id' => $story->id]);

    }

    /** @test */
    public function a_registered_user_can_update_story()
    {
//        $this->withoutExceptionHandling();

        $story = StoryFactory::ownedBy($this->signIn())->create();
        $story->update(['title' => 'changed']);

        $this->assertDatabaseHas('stories', ['title' => 'changed']);

    }

    /** @test */
    public function a_story_belongs_to_user()
    {
//        $this->withoutExceptionHandling();

        $story = StoryFactory::ownedBy($this->signIn())->create();

        $this->assertDatabaseHas('stories', ['owner_id' => auth()->id()]);

    }
    
    /** @test */
    public function a_story_cannot_skip_more_or_equal_steps_than_the_number_of_participants(){
        $this->withoutExceptionHandling();

//      Use update on story to set higher skipsteps than participants - assert it fails.
        $story = StoryFactory::ownedBy($this->signIn())->create();
        $story->update([
            'max_participant'   => 10,
            'skip_step'         => 11
        ]);

        $this->assertDatabaseMissing('stories', [
            'max_participant'   => 10,
            'skip_step'         => 11
        ]);

    }

    /** @test */
    public function a_story_can_have_many_participants(){
        
    }

    /** @test */
    public function a_story_must_have_title(){

    }

    /** @test */
    public function a_story_must_have_description(){

    }

    /** @test */
    public function a_story_can_have_genre(){

    }

    /** @test */
    public function a_story_can_have_max_participants(){

    }

    /** @test */
    public function a_story_can_have_chars_per_turn(){

    }

    /** @test */
    public function a_story_can_have_skip_step(){

    }

    /** @test */
    public function a_story_can_have_visible_history(){

    }

    /** @test */
    public function a_story_can_have_notes(){

    }

    /** @test */
    public function a_story_can_be_public(){

    }

    /** @test */
    public function a_public_story_can_be_seen_by_all_users_and_guests(){

    }

    /** @test */
    public function a_private_story_can_be_seen_only_by_invited_users_and_owner(){

    }

    /** @test */
    public function a_story_can_be_finished(){

    }

    /** @test */
    public function a_finished_story_can_not_be_edited(){

    }

    /** @test */
    public function a_story_can_be_published(){

    }

    /** @test */
    public function a_published_story_can_be_viewed_by_everyone(){

    }

    /** @test */
    public function a_story_can_be_deleted(){

    }
}
