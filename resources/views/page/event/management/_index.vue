<template>
    <div id="event-management">
        <panel title="Kelola Kegiatan">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Poster</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Alamat Acara</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr v-if="event.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in event.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td @click="openImage(data.poster_full_url)">
                                <img :src="data.poster_full_url">
                            </td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.description }}</td>
                            <td>{{ data.address }}</td>
                            <td width="150px" class="text-center">
                                <i class="fa fa-edit" @click="editEvent(data)"></i>
                                <i class="fa fa-trash" @click="confirmationDeleteEvent(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="event" @changePaginate="changePaginate"></paginate>
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
        data() {
            return {
                event: {
                    data: []
                },
                filter: {
                    text: "",
                    page: 1,
                    per_page: 10
                }
            }
        },
        watch: {
            selectedRegion: {
                immediate: true,
                deep: true,
                handler() {
                    this.getEvent()
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
        methods: {
            getEvent() {
                if(this.accessToken) {
                    request.get('/api/event?filter[text]=' + this.filter.text + '&filter[page]=' + this.filter.page + '&filter[per_page]=' + this.filter.per_page + '&filter[region_id]=' + this.selectedRegion.id, this.accessToken)
                    .then((response) => {
                        if(response.data.success)
                            this.event = response.data.result
                    })
                }
            },
            search(text) {
                this.filter.text = text

                this.getEvent()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getEvent()
            },
            openImage(url) {
                window.open(url, '_target')
            },
            editEvent(data) {
                this.$router.push({
                    name: "Edit Event",
                    params: {data: data}
                })
            },
            confirmationDeleteEvent(data) {
                alert.confirmation('Apakah kamu yakin untuk menghapus acara ' + data.name + ' ?', 'Hapus', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.deleteEvent(data.id)
                })
            },
            deleteEvent(id) {
                alert.loading()

                request.post('/api/event/delete/'+id, null, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getEvent()
                    }else
                        alert.error()
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #event-management
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
