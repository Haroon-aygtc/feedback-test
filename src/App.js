import { I18nextProvider, useTranslation } from 'react-i18next';
import { SurveyProvider } from './components/Survey/context/SurveyContext.js';
import Loader from "./components/common/Loader.js";
import {LoadingProvider, useLoading} from "./components/Survey/context/LoadingContext.js";
import Welcome from "./components/Survey/Welcome.js";

function App() {
    const { i18n } = useTranslation();

    return (
        <I18nextProvider i18n={i18n}>
            <LoadingProvider>
                <SurveyProvider>
                    <Main />
                </SurveyProvider>
            </LoadingProvider>
        </I18nextProvider>
    );
}

const Main = () => {
    const { loading } = useLoading();
    return (
        <>
            {loading ? (
                <Loader message="Loading Survey..." />
            ) : (
                    <Welcome />
            )}
        </>
    );
};


export default App;