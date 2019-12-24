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
                        </tr>
                        <tr v-if="event.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in event.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.poster_url }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.description }}</td>
                            <td>{{ data.address }}</td>
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
        mounted() {
            this.getEvent()
        },
        methods: {
            getEvent() {
                request.get('/api/event?filter[text]='+ this.filter.text + '&filter[page]='+ this.filter.page +'&filter[per_page]=' + this.filter.per_page, this.accessToken)
                .then((response) => {
                    this.event = response.data.result
                })
            },
            search(text) {
                this.filter.text = text

                this.getEvent()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getEvent()
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
</style>
