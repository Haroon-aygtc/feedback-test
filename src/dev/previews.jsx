import React from 'react'
import {ComponentPreview, Previews} from '@react-buddy/ide-toolbox'
import {PaletteTree} from './palette'
import App from "../App.js";
import SurveyForm from "../components/Survey/SurveyForm.js";
import RatingComponent from "../components/Survey/components/RatingComponent.js";

const ComponentPreviews = () => {
    return (
        <Previews palette={<PaletteTree/>}>
            <ComponentPreview path="/SurveyForm">
                <SurveyForm/>
            </ComponentPreview>
            <ComponentPreview path="/App">
                <App/>
            </ComponentPreview>
            <ComponentPreview path="/PaletteTree">
                <PaletteTree/>
            </ComponentPreview>
            <ComponentPreview path="/RatingComponent">
                <RatingComponent/>
            </ComponentPreview>
        </Previews>
    )
}

export default ComponentPreviews