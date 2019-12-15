import Content from '../../views/layout/content/_index.vue'

export default {
    data: [
        {
            title: 'Home',
            path: '/',
            icon: "fa fa-home",
            name: 'home',
            active: false,
            component: () => import('../../views/page/home/_index.vue')
        },
        {
            path: '/login',
            name: 'Login',
            component: () => import('../../views/page/login/_index')
        },
        {
            path: '/logout',
            name: 'Logout',
        },
        {
            title: 'Pengguna',
            path: '/user',
            icon: "fas fa-users",
            active: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add User',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Pengguna'
                    },
                    component: () => import('../../views/page/user/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'User Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Pengguna'
                    },
                    component: () => import('../../views/page/user/management/_index.vue')
                }
            ]
        },
        {
            title: 'Kecamatan',
            path: '/region',
            icon: "fa fa-globe",
            active: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add Region',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Kecamatan'
                    },
                    component: () => import('../../views/page/region/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'Region Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Kecamatan'
                    },
                    component: () => import('../../views/page/region/management/_index.vue')
                }
            ]
        },
        {
            title: 'Vihara',
            path: '/vihara',
            icon: "fas fa-vihara",
            active: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add Vihara',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Vihara'
                    },
                    component: () => import('../../views/page/vihara/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'Vihara Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Vihara'
                    },
                    component: () => import('../../views/page/vihara/management/_index.vue')
                }
            ]
        },
        {
            title: 'Kegiatan',
            path: '/event',
            icon: "fa fa-calendar",
            active: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add Event',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Kegiatan'
                    },
                    component: () => import('../../views/page/event/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'Event Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Kegiatan'
                    },
                    component: () => import('../../views/page/event/management/_index.vue')
                }
            ]
        },
        {
            title: 'Orang Meninggal',
            path: '/deceased',
            icon: "fas fa-book-dead",
            active: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add Deceased',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Orang Meninggal'
                    },
                    component: () => import('../../views/page/deceased/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'Deceased Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Orang Meninggal'
                    },
                    component: () => import('../../views/page/deceased/management/_index.vue')
                }
            ]
        },
        {
            title: 'Donasi',
            path: '/donation',
            icon: "fas fa-donate",
            active: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add Donation',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Donasi'
                    },
                    component: () => import('../../views/page/donation/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'Donation Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Donasi'
                    },
                    component: () => import('../../views/page/donation/management/_index.vue')
                }
            ]
        },
        {
            title: 'Permohonan KTUB',
            path: '/request-ktub',
            icon: "fa fa-id-card",
            active: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add Request KTUB',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Permohonan KTUB'
                    },
                    component: () => import('../../views/page/request_ktub/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'Request KTUB Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Permohonan KTUB'
                    },
                    component: () => import('../../views/page/request_ktub/management/_index.vue')
                }
            ]
        }
    ]
}
