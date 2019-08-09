<template>
    <div>
        <vuetable ref="vuetable"
                  :api-url="datadest"
                  :fields="fields"
                  :sort-order="sortOrder"
                  data-path="data"
                  :per-page="5"
                  pagination-path=""
                  scrollVisible="false"
                  :table-height="'100'"
                  @vuetable:pagination-data="onPaginationData"
        >
            <div slot="custom-actions" slot-scope="props">
                <button class="ui basic button" @click="onActionClicked('view-item', props.rowData)">
                    <i class="zoom icon"></i>
                </button>
                <button class="ui basic button" @click="onActionClicked('edit-item', props.rowData)">
                    <i class="edit icon"></i>
                </button>
                <button class="ui basic button" @click="onActionClicked('delete-item', props.rowData)">
                    <i class="delete icon"></i>
                </button>
            </div>
        </vuetable>


        <!--api-url="https://vuetable.ratiw.net/api/users"-->

        <div class="pagination ui basic segment grid">
            <vuetable-pagination-info ref="paginationInfo"
            ></vuetable-pagination-info>

            <vuetable-pagination ref="pagination"
                                 @vuetable-pagination:change-page="onChangePage"
            ></vuetable-pagination>

        </div>
    </div>
</template>
<script>
    import Vuetable from "vuetable-2/src/components/Vuetable";
    import VuetablePagination from "vuetable-2/src/components/VuetablePagination";
    import VuetablePaginationInfo from "vuetable-2/src/components/VuetablePaginationInfo";
    import FieldsDef from "./FieldsDef.js";
    import sweetAlert from "sweetalert2";

    export default {
        name: "MyVuetable",
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo
        },
        data() {
            return {
                fields: FieldsDef,
                sortOrder: [
                    {
                        field: "title",
                        direction: "asc"
                    }
                ]
            };
        },
        methods: {
            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData);
                this.$refs.paginationInfo.setPaginationData(paginationData);
            },
            onChangePage(page) {
                this.$refs.vuetable.changePage(page);
            },
                onActionClicked(action, data) {
                    console.log(action);
                    console.log(data);
                    if (action == 'delete-item') {
                        sweetAlert.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.value) {
                            sweetAlert.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                    } else {
                        sweetAlert.fire({
                            title: action,
                            text: data.title,
                            type: 'success',
                            confirmButtonText: 'Cool'
                        });
                    }
                    //https://sweetalert2.github.io/#examples
                // sweetAlert(action, data.title);
            },
        },
        props: ['datadest'],
    };
</script>

<style>
    .pagination {
        margin-top: 1rem;
    }

    .vuetable-head-wrapper table.vuetable th.sortable {
        cursor: pointer
    }

    tbody.vuetable-body td {
        vertical-align: middle;
    }
</style>
