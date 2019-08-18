import VuetableFieldSwitch from './VuetableFieldSwitch.vue'
import VuetableFieldTitle from './VuetableFieldTitle.vue'

export default [
    // {
    //     name: VuetableFieldSwitch,
    //     title: 'Toggle Switch',
    //     titleClass: 'center aligned',
    //     dataClass: 'left aligned',
    //     width: "6%",
    //     switch: {
    //         // label: 'Male?',
    //         label: (data) => data.name,
    //         field: (data) => data.gender === 'M',
    //     }
    // },
    // {
    //     name: "id",
    //     title: '<i class="grey user outline icon"></i>ID',
    //     width: "6%",
    //     sortField: "id"
    // },
    {
        name: "title",
        // name: VuetableFieldTitle,
        title: '<i class="grey mail outline icon"></i>Title',
        width: "25%",
        // sortField: "title",
        sortField: 'title',
        titleField: {
            title: (data) => data.title,
            id: (data) => data.id
        },
        // formatter: (data) => console.log(data.id)//"<b>"+data+"</b>"
    },
    {
        name: "description",
        title: '<i class="grey mail outline icon"></i>description',
        width: "30%",
        sortField: "description"
    },
    {
        name: "participants",
        title: '<i class="grey mail outline icon"></i>Joined',
        width: "7%",
        // sortField: "participants"
    },
    {
        name: "created_at",
        title: '<i class="grey mail outline icon"></i>Created',
        width: "12%",
        sortField: "created_at"
    },
    {
        name: "updated_at",
        title: '<i class="grey mail outline icon"></i>Updated',
        width: "12%",
        sortField: "updated_at"
    },
    {
        name: "custom-actions",
        title: "Actions",
        width: "12%",
        titleClass: "center aligned",
        dataClass: "center aligned"
    }
    // {
    //     name: "group.description",
    //         sortField: "group_id",
    //         title: '<i class="grey sitemap icon"></i>Group',
    //         width: "15%"
    // },
    // {
    //     name: "gender",
    //         title: '<i class="grey heterosexual icon"></i>Gender',
    //     titleClass: "center aligned",
    //     dataClass: "center aligned",
    //     width: "15%",
    //     formatter: value => {
    //     return value.toUpperCase() === "M"
    //         ? '<span class="ui teal label"><i class="large man icon"></i>Male</span>'
    //         : '<span class="ui pink label"><i class="large woman icon"></i>Female</span>';
    //     },
    //     sortField: "gender"
    // },
];
