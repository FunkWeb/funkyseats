import React, { useState } from "react";
import ReactRenderer from './src/ReactRenderer'

import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

const Example = () => {
    const [startDate, setStartDate] = useState(new Date());
    return (
        <DatePicker selected={startDate} onChange={(date) => setStartDate(date)} />
    );
};

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
