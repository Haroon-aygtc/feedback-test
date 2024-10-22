import React from "react"
import {Fragment} from "react"
import {
    Category,
    Component,
    Variant,
    Palette,
} from "@react-buddy/ide-toolbox"
import SurveyStepPanel from "../components/Survey/SurveyStepPanel.js";
import Welcome from "../components/Survey/Welcome.js";
import Loader from "../components/common/Loader.js";

export const PaletteTree = () => (
    <Palette>
        <Category name="App">
            <Component name="Loader">
                <Variant>
                    <Loader/>
                </Variant>
                <Variant name="loader">
                    <Loader/>
                </Variant>
            </Component>
            <Component name="SurveyStepPanel">
                <Variant>
                    <SurveyStepPanel/>
                </Variant>
            </Component>
            <Component name="Welcome">
                <Variant>
                    <Welcome/>
                </Variant>
            </Component>
        </Category>
    </Palette>
)

export function ExampleLoaderComponent() {
    return (
        <Fragment>Loading...</Fragment>
    )
}