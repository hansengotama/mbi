import Content from '../../views/layout/content/_index.vue'

export default {
    data: [
        {
            title: 'Home',
            path: '/',
            icon: "fa fa-home",
            name: 'Home',
            roles: ['super_admin', 'admin', 'pic_kecamatan'],
            active: false,
            show: false,
            component: () => import('../../views/page/home/_index.vue')
        },
        {
            path: '/edit-profile',
            name: 'Edit Profile',
            roles: ['super_admin', 'admin', 'pic_kecamatan'],
            component: () => import('../../views/page/profile/edit/_index')
        },
        {
            path: '/change-password',
            name: 'Change Password',
            roles: ['super_admin', 'admin', 'pic_kecamatan'],
            component: () => import('../../views/page/profile/change_password/_index')
        },
        {
            path: '/login',
            name: 'Login',
            roles: ['super_admin', 'admin', 'pic_kecamatan'],
            component: () => import('../../views/page/login/_index')
        },
        {
            path: '/logout',
            name: 'Logout',
            roles: ['super_admin', 'admin', 'pic_kecamatan']
        },
        {
            title: 'Kabupaten',
            path: '/district',
            icon: "fa fa-globe",
            roles: ['super_admin'],
            active: false,
            show: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add District',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Kabupaten'
                    },
                    component: () => import('../../views/page/district/add/_index.vue')
                },
                {
                    path: 'edit',
                    name: 'Edit District',
                    meta: {
                        parentTitle: 'Kabupaten'
                    },
                    component: () => import('../../views/page/district/edit/_index.vue')
                },
                {
                    path: 'management',
                    name: 'District Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Kabupaten'
                    },
                    component: () => import('../../views/page/district/management/_index.vue')
                }
            ]
        },
        {
            title: 'Admin',
            path: '/admin',
            icon: 'fas fa-users',
            roles: ['super_admin'],
            active: false,
            show: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add Admin',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'Admin'
                    },
                    component: () => import('../../views/page/admin/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'Admin Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'Admin'
                    },
                    component: () => import('../../views/page/admin/management/_index.vue')
                }
            ]
        },
        {
            title: 'Pengguna',
            path: '/user',
            icon: "fas fa-users",
            roles: ['admin'],
            active: false,
            show: false,
            component: Content,
            children: [
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
            roles: ['admin'],
            active: false,
            show: false,
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
                    path: 'edit',
                    name: 'Edit Region',
                    meta: {
                        parentTitle: 'Kecamatan'
                    },
                    component: () => import('../../views/page/region/edit/_index.vue')
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
            title: 'PIC Kecamatan',
            path: '/pic-region',
            icon: "fa fa-users",
            roles: ['admin'],
            active: false,
            show: false,
            component: Content,
            children: [
                {
                    path: 'add',
                    name: 'Add PIC Region',
                    title: 'Tambahkan',
                    meta: {
                        parentTitle: 'PIC Kecamatan'
                    },
                    component: () => import('../../views/page/pic_region/add/_index.vue')
                },
                {
                    path: 'management',
                    name: 'PIC Region Management',
                    title: 'Kelola',
                    meta: {
                        parentTitle: 'PIC Kecamatan'
                    },
                    component: () => import('../../views/page/pic_region/management/_index.vue')
                }
            ]
        },
        {
            title: 'Vihara',
            path: '/vihara',
            icon: "fas fa-vihara",
            roles: ['admin', 'pic_kecamatan'],
            active: false,
            show: false,
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
                    path: 'edit',
                    name: 'Edit Vihara',
                    meta: {
                        parentTitle: 'Vihara'
                    },
                    component: () => import('../../views/page/vihara/edit/_index.vue')
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
            roles: ['admin', 'pic_kecamatan'],
            active: false,
            show: false,
            component: Content,
            children: [
                {
                    path: 'edit',
                    name: 'Edit Event',
                    meta: {
                        parentTitle: 'Kegiatan'
                    },
                    component: () => import('../../views/page/event/edit/_index.vue')
                },
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
            roles: ['admin', 'pic_kecamatan'],
            active: false,
            show: false,
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
                    path: 'edit',
                    name: 'Edit Deceased',
                    meta: {
                        parentTitle: 'Orang Meninggal'
                    },
                    component: () => import('../../views/page/deceased/edit/_index.vue')
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
            roles: ['admin'],
            active: false,
            show: false,
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
                    path: 'edit',
                    name: 'Edit Donation',
                    meta: {
                        parentTitle: 'Donasi'
                    },
                    component: () => import('../../views/page/donation/edit/_index.vue')
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
            roles: ['admin'],
            active: false,
            show: false,
            component: Content,
            children: [
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
