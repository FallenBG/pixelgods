<template>
    <th v-if="isHeader"
        class="vuetable-th-component-switch"
        v-html="title"
    ></th>
    <td v-else
        class="vuetable-td-component-switch"
    >
        <div class="ui toggle checkbox">
            <input type="checkbox"
                   @change="toggleSwitch(rowData, $event)"
                   :checked="checkValue(rowData, rowField)"
            >
            <label v-if="rowField.switch.label">{{ label(rowData, rowField) }}</label>
        </div>
    </td>
</template>
<script>
    import $ from 'jquery'
    import VuetableFieldMixin from 'vuetable-2/src/components/VuetableFieldMixin.vue'

    export default {
        name: 'vuetable-field-switch',

        mixins: [VuetableFieldMixin],

        methods: {
            toggleSwitch(data, event) {
                console.log('toggleSwitch: ', event.target.checked)
            },

            label(rowData, rowField) {
                return typeof(rowField.switch.label) === 'function'
                    ? rowField.switch.label(rowData)
                    : rowField.switch.label
            },

            checkValue(rowData, rowField) {
                return typeof(rowField.switch.field) === 'function'
                    ? rowField.switch.field(rowData)
                    : rowData[rowField.switch.field]
            }
        }
    }
</script>
