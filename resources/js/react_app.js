import React, { useState } from "react";
import ReactRenderer from './src/ReactRenderer'

import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import { registerLocale, setDefaultLocale } from  "react-datepicker";
import nb from 'date-fns/locale/nb';
registerLocale('nb', nb)

class Example extends React.Component {
    changeDate(date) {  useState(new date())};

    render() {
        const changeDate = () => {
            alert("hello");
        };
    return (
        <div>
            <DatePicker dateFormat="dd-M-yyyy"
                        value={this.props.value}
                        onChange={changeDate}/>
        </div>
    )
}
}

const components = [
    {
        name: "DatePicker",
        component: <DatePicker />,
    },
    {
        name: "Example",
        component: <Example />,
    },
]

new ReactRenderer(components).renderAll()
export default Example
