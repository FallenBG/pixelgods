<?php /** @var App\Story $story */ ?>
<?php /** @var App\StoriesEntries $entry */ ?>

<div class="form-group row">

    <label for="title" class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="title" value="{{ $story->title }}" name="title" required>
    </div>
    <div class="col-sm-4">
        <story-button v-if="{{$create}}"
                :story="{{ json_encode($story) }}"
                :prop="{{ json_encode('finish') }}"
        ></story-button>
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-6">
        <textarea cols="30" rows="5" class="form-control" id="description" name="description" required>{{ $story->description }}</textarea>
    </div>
    <div class="col-sm-4">

        <story-button v-if="{{$create}}"
                :story="{{ json_encode($story) }}"
                :prop="{{ json_encode('publish') }}"
        ></story-button>
    </div>
</div>
<div class="form-group row">
    <label for="genre" class="col-sm-2 col-form-label"
           data-toggle="tooltip" data-placement="left" title="Write the genre of the story up to 100 chars. Let them comma separated.">
        Genre
    </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" id="genre" value="{{ $story->genre }}" name="genre" required>
    </div>
</div>
<div class="form-group row">
    <label for="participants" class="col-sm-2 col-form-label"
           data-toggle="tooltip" data-placement="left" title="The maximum number of people who can join the Story.">
        Participants
    </label>
    <div class="col-sm-1">
        <input type="number" class="form-control" id="participants" value="{{ $story->max_participants }}" name="max_participants" required>
    </div>
</div>
<div class="form-group row">
    <label for="skipStep" class="col-sm-2 col-form-label"
           data-toggle="tooltip" data-placement="left" title="How many writers must continue the story before the User can put another entry.
           If this number is bigger than the number of participants then we'll use participants minus one.">
        Skip Steps
    </label>
    <div class="col-sm-1">
        <input type="number" class="form-control" id="skipStep" value="{{ $story->skip_step }}" name="skip_step" required>
    </div>
</div>
<div class="form-group row">
    <label for="chars" class="col-sm-2 col-form-label"
           data-toggle="tooltip" data-placement="left" title="The maximum number of characters a writer can enter when it's his turn.">
        Chars per turn
    </label>
    <div class="col-sm-1">
        <input type="number" class="form-control" id="chars" value="{{ $story->chars_per_turn }}" name="chars_per_turn" required>
    </div>
</div>
<div class="form-group row">
    <label for="visibleEntries" class="col-sm-2 col-form-label"
           data-toggle="tooltip" data-placement="left" title="How many previous entries to be visible to the participants.
           For example if the story have 100 entries and the value here is 3 - only the last 3 entries will be visible to the writers to refresh their memory.
           Value of 1 can bring a lot of funny moments after the story is finished :) ">
        Visible Entries
    </label>
    <div class="col-sm-1">
        <input type="number" class="form-control" id="visibleEntries" value="{{ $story->visible_history }}" name="visible_history" required>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-2"
         data-toggle="tooltip" data-placement="left" title="Allow other users to join the story without invitation.
         That means any registered user can see the story as it unfolds.
         They won't be able to participate nor see the chat unless they choose to join."
    >
        Public Story
    </div>
    <div class="col-sm-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="public" {{ $story->public ? 'checked' : ''}} name="public" >
        </div>
    </div>
</div>

@include('partials.errors', [
    'class' => 'w-100'
])