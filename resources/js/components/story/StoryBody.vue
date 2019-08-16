<template>
    <div class="card" style="width: 100%;">
        <div class="card-header"><h1>{{ this.story.title }}</h1></div>


        <div class="card-body">
            <div class="scroll-box" id="storyBox" style="border:1px solid gray;" v-model="storyBox">
                <p v-for="entry in entries">
                    {{ entry.entry }} <b>({{ entry.user.name }})</b>
                </p>
            </div>
            <div>
                <div class="float-left mt-3">
                    You can see the last {{ this.story.visible_history  }} entries.<br>
                    Skip step rule states that you must wait {{ this.story.skip_step }} writers after your entry to be able to continue.
                </div>

                <div class="float-right mt-3">
                    Font size:
                    <button  onclick="resizeText(1, 'storyBox')" class="mt-2">+</button>
                    <button onclick="resizeText(-1, 'storyBox')" class="mt-2">-</button>
                    <input class="jscolor {onFineChange:'update(this)'} form-control width80 float-right ml-4" data-text="storyBox">
                </div>
                <br>
            </div>
        </div>

        <div class="card-footer" v-if="contains">
            <div v-if="waiting >= story.skip_step">
                <textarea rows="10" id="entryBox" class="width100p" v-model="newEntry" :maxlength="story.chars_per_turn"></textarea>
                <div class="row">
                    <div class="col-md-6">Chars Left: {{ story.chars_per_turn - newEntry.length}}</div>
                    <div class="col-md-6">
                        <div class="row-mt-12 float-right mr-2">
                            <button type="button" class="btn btn-primary btn-lg" @click="sendEntry">Send</button>
                        </div>
                        <div class="row-mt-12 float-right mr-5">
                            <input class="jscolor {onFineChange:'update(this)'} form-control width80 float-right mt-1 ml-4" data-text="entryBox">
                            <div class="float-right mt-2">
                                Font size:
                                <button onclick="resizeText(1, 'entryBox')">+</button>
                                <button onclick="resizeText(-1, 'entryBox')">-</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div v-else>
                You must wait for {{ story.skip_step - waiting}} more writers.
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from "sweetalert2";

    export default {
        mounted() {
            setTimeout(this.scrollToBottom, 1000);
        },

        created() {
            this.fetchEntries();

            // The event listener and join.
            Echo.join('story.'+this.story.id)
                .here(users => (this.users = users))
                .joining(user => this.users.push(user))
                .leaving(user => (this.users = this.users.filter(u => (u.id !== user.id))))
                .listen('StoryEvent', (e) => {
                    // Push the entry to the others
                    this.entries.push({
                        entry: e.storiesEntries.entry,
                        user: e.user
                    });

                    // Increment waiting but never bigger than skip_step.
                    this.waiting++
                    if (this.waiting > this.story.skip_step) {
                        this.waiting = this.story.skip_step;
                    }
                    // Remove old entries if we have more than the allowed visible_history
                    if (this.entries.length > this.story.visible_history) {
                        this.entries.shift();
                    }

                    setTimeout(this.scrollToBottom, 10);
                });
        },

        methods: {
            scrollToBottom() {
                $("#storyBox").scrollTop($("#storyBox")[0].scrollHeight);
            },

            sendEntry() {
                // Emit the event to be broadcasted to others
                this.$emit('StoryEvent', {
                    user: this.user,
                    entry: this.newEntry
                });

                this.send();

            },

            fetchEntries() {
                axios.get('/story/'+this.story.id+'/entry').then(response => {
                    // Clone the entries array
                    let reversed = JSON.parse(JSON.stringify(response.data));

                    // Get only the visible entries (last visible_history from the array)
                    this.entries = response.data.slice(Math.max(response.data.length - this.story.visible_history, 0));
                    // console.log(response.data);

                    // Reverse it again to get the newest first
                    reversed.reverse();
                    console.log(reversed);
                    // waiting will show how many people wrote after the user - 0 means the user wrote last.
                    this.waiting  = Object.keys(reversed).find(key => reversed[key].user_id === this.user.id);
                    console.log(this.waiting);
                    // Stupid way to determine the user can write if we can't find him in the entries available.
                    if (isNaN(this.waiting)) this.waiting = this.story.skip_step;


                });
            },

            send() {
                let url = '/story/'+this.story.id+'/entry';
                // Made a promise to post the entry to the DB
                return new Promise((resolve, reject) => {
                    axios['post'](url, {'entry': this.newEntry, 'user_id': this.user.id, 'story_id': this.story.id})
                        .then(response => {
                            this.onSuccess(response.data);

                            resolve(response.data);
                        })
                        .catch(error => {
                            this.onFail(error.response.data);

                            reject(error.response.data);
                        })
                });
            },

            onSuccess(data) {
                // Push the story to the local story so the user can see it.
                this.entries.push({
                    entry: this.newEntry,
                    user: this.user
                });

                // I just wrote - set me to 0 and increment on listen until reach skip_step;
                this.waiting = 0;

                // Remove old entries if we have more than the allowed visible_history
                if (this.entries.length > this.story.visible_history) {
                    this.entries.shift();
                }

                this.newEntry = '';

                setTimeout(this.scrollToBottom, 10);

            },

            onFail(errors) {
                console.log(errors);
                Swal.fire({
                    type: 'error',
                    title: errors.message,
                    text: errors.errors.entry,
                    // footer: '<a href>Why do I have this issue?</a>'
                })
            }
        },
        props: ['user', 'story', 'contains'],
        data() {
            return {
                storyBox: '',
                entry: '',
                newEntry: '',
                entries: [],
                waiting: '',
            }
        },
    }
</script>
