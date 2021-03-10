import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@fortawesome/fontawesome-free/css/all.css'
import Vue from 'vue';
import Vuetify from 'vuetify/lib';

Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        primary: "#f44336",
        secondary: "#e57373",
        accent: "#f4f5f6",
        error: "#f44336",
        warning: "#ffeb3b",
        info: "#2196f3",
        success: "#0B98D5",
        backgroundWhite: "#ffffff",
        backgroundSidebar: "#0998D5",
        black: "#333",
        buttonsave: "#0998D5",
        bgAttachment: "#c5c5c5",
        green: "#2CA01C",
        
    },
    icons: {
        iconfont: 'md' || 'fa',
    },
});

