<template>
    <div id="deceased-management">
        <panel title="Kelola Orang Meninggal">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Umur Terakhir</th>
                            <th>Tgl Pemakaman</th>
                            <th>Tempat Pemakaman</th>
                            <th>Tgl Meninggaal</th>
                            <th>Tipe</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr v-if="deceased.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in deceased.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td @click="openImage(data.photo_full_url)">
                                <img :src="data.photo_full_url">
                            </td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.close_age }}</td>
                            <td>{{ data.buried_date | dateFormat('DD MMMM YYYY') }}</td>
                            <td>{{ data.deceased_date | dateFormat('DD MMMM YYYY') }}</td>
                            <td>{{ data.buried_at }}</td>
                            <td>{{ data.type }}</td>
                            <td width="150px" class="text-center">
                                <i class="fa fa-edit" @click="editDeceased(data)"></i>
                                <i class="fa fa-trash" @click="confirmationDeleteDeceased(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="deceased" @changePaginate="changePaginate"></paginate>
            </template>
        </panel>
    </div>
</template>

<script>
    import request from "../../../../helper/request"
    import alert from "../../../../helper/alert";

    export default {
        props: ['accessToken'],
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            Search: () => import('../../../../components/search/_index'),
            Paginate: () => import('../../../../components/paginate/_index')
        },
        watch: {
            selectedRegion: {
                immediate: true,
                deep: true,
                handler() {
                    this.getDeceased()
                }
            }
        },
        computed: {
            selectedRegion: {
                get() {
                    return this.$store.getters["getSelectedRegion"]
                },
                set(value) {
                    this.$store.commit("setSelectedRegion", value)
                }
            }
        },
        data() {
            return {
                deceased: {
                    data: []
                },
                filter: {
                    text: "",
                    page: 1,
                    per_page: 10
                }
            }
        },
        methods: {
            getDeceased() {
                if(this.accessToken) {
                    request.get('/api/deceased?filter[text]=' + this.filter.text + '&filter[page]=' + this.filter.page + '&filter[per_page]=' + this.filter.per_page + '&filter[region_id]=' + this.selectedRegion.id, this.accessToken)
                    .then((response) => {
                        if(response.data.success)
                            this.deceased = response.data.result
                    })
                }
            },
            search(text) {
                this.filter.text = text

                this.getDeceased()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getDeceased()
            },
            openImage(url) {
                window.open(url, '_target')
            },
            editDeceased(data) {
                this.$router.push({
                    name: "Edit Deceased",
                    params: {data: data}
                })
            },
            confirmationDeleteDeceased(data) {
                alert.confirmation('Apakah kamu yakin untuk menghapus ' + data.name + ' ?', 'Hapus', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.deleteDeceased(data)
                })
            },
            async deleteDeceased(data) {
                alert.loading()

                await this.removeImage(data.photo_url)
                 request.post('/api/deceased/delete/'+data.id, null, this.accessToken)
                    .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getDeceased()
                    }else
                        alert.error()
                })
            },
            removeImage(photoUrl) {
                return request.post("/api/assets/remove", {file_path: photoUrl}, this.accessToken)
                .then((response) => {
                    if(!response.data.success)
                        alert.error()
                })
            },
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #deceased-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em

    img
        width 80px
        height 80px
        cursor pointer

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
