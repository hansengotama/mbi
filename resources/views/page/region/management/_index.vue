<template>
    <div id="region-management">
        <panel title="Kelola Kecamatan">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr v-if="region.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in region.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.name }}</td>
                            <td width="150px" class="text-center">
                                <i class="fa fa-edit" @click="editRegion(data)"></i>
                                <i class="fa fa-trash" @click="confirmationDeleteRegion(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="region" @changePaginate="changePaginate"></paginate>
            </template>
        </panel>
    </div>
</template>

<script>
    import request from "../../../../helper/request"
    import alert from "../../../../helper/alert"

    export default {
        props: ['accessToken'],
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            Search: () => import('../../../../components/search/_index'),
            Paginate: () => import('../../../../components/paginate/_index')
        },
        data() {
            return {
                region: {
                    data: []
                },
                filter: {
                    text: "",
                    page: 1,
                    per_page: 10
                }
            }
        },
        computed: {
            userLogin: {
                get() {
                    return this.$store.getters["getUserLogin"]
                },
                set(value) {
                    this.$store.commit("setUserLogin", value)
                }
            }
        },
        mounted() {
            this.getRegion()
        },
        methods: {
            getRegion() {
                if(this.accessToken && this.userLogin.district_id) {
                    request.get('/api/region?filter[text]='+ this.filter.text + '&filter[page]='+ this.filter.page +'&filter[per_page]=' + this.filter.per_page + '&filter[district_id]=' + this.userLogin.district_id, this.accessToken)
                    .then((response) => {
                        this.region = response.data.result
                    })
                }
            },
            search(text) {
                this.filter.text = text

                this.getRegion()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getRegion()
            },
            confirmationDeleteRegion(data) {
                alert.confirmation('Apakah kamu yakin untuk menghapus kecamatan ' + data.name + ' ?', 'Hapus', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.deleteRegion(data.id)
                })
            },
            deleteRegion(id) {
                alert.loading()

                request.post('/api/region/delete/'+id, null, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getRegion()
                    }else
                        alert.error()
                })
            },
            editRegion(data) {
                this.$router.push({
                    name: "Edit Region",
                    params: {data: data}
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #region-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em

    td > .fa,
    td > .fas
        padding 6px
        color white
        border-radius 4px
        cursor pointer

    td > .fa-edit
        margin-right 4px
        background $orange

    td > .fa-trash
        background red
</style>
