import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from 'ziggy-js'
import Toaster from '@meforma/vue-toaster'
import ToastPlugin from 'vue-toast-notification'
import axios from 'axios' // Import axios module

// import { VBHover } from 'bootstrap-vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'
import 'flowbite'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(LaravelPermissionToVueJS)
      .use(plugin)
      .use(Toaster, {
      // One of the options
        position: 'top',
      })
      .use(ToastPlugin)
      .use(ZiggyVue)
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})

