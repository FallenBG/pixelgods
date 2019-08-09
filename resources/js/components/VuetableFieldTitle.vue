<template>
    <th v-if="isHeader"
        class="vuetable-th-component-switch"
        v-html="title"
    ></th>
    <td v-else
        class="vuetable-td-component-switch"
    >
        <div class="ui toggle checkbox">
            <a :href="/story/+storyId(rowField.titleField.id, rowData)">
                {{titleText(rowField.titleField.title, rowData)}}
            </a>
            <label v-if="rowField.titleField.label">{{ label(rowField.titleField.title, 'asd') }}</label>
        </div>
    </td>
</template>
<script>
    import $ from 'jquery'
    import VuetableFieldMixin from 'vuetable-2/src/components/VuetableFieldMixin.vue'

    export default {
        name: 'vuetable-field-title',

        mixins: [VuetableFieldMixin],

        methods: {

            storyId(id, rowData) {
                if (typeof(id) === 'function') {
                    id = id(rowData);
                }

                return id;
            },

            titleText(title, rowData) {
                if (typeof(title) === 'function') {
                    title = title(rowData);
                }

                return title;
            },
        }
    }
</script>
