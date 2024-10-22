import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App.js';
import './localization/i18n.js';
import reportWebVitals from './reportWebVitals.js';
import { DevSupport } from "@react-buddy/ide-toolbox";
import {ComponentPreviews, useInitial} from "./dev/index.js";

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <React.StrictMode>
        <DevSupport ComponentPreviews={ComponentPreviews} useInitialHook={useInitial}>
            <App />
        </DevSupport>
    </React.StrictMode>
);

reportWebVitals();
