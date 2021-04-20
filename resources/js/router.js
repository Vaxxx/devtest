import Vue from 'vue'
import VueRouter from 'vue-router'
import DashboardComponent from "./components/DashboardComponent";
import GigComponent from  "./views/GigComponent";
import FirstComponent from "./views/FirstComponent";
import CompanyComponent from "./views/CompanyComponent";
import AccountComponent from "./views/AccountComponent";
import AddGigComponent from "./views/AddGigComponent";

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: '/',
        component: DashboardComponent
    },
    {
        path: '/gig',
        name: 'gig',
        component: GigComponent
    },
    {
        path: '/first',
        name: 'first',
        component: FirstComponent
    },
    {
        path: '/company',
        name: 'company',
        component: CompanyComponent
    },
    {
        path: '/account',
        name: 'account',
        component: AccountComponent
    },
    {
        path: '/addgig',
        name: 'addgig',
        component: AddGigComponent
    }

];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
    linkActiveClass: 'active'
})

export default  router;
