import React, { useState } from 'react';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm, usePage } from '@inertiajs/react';

dayjs.extend(relativeTime);

export default function Vehicle({data,}) {

    const { auth } = usePage().props;

    return (
        <div className="p-6 flex flex-col space-x-2">
            <div className="flex-1">
                <h3 className="italic text-lg">{data.name}</h3>
            </div>
            <div className="flex-1 pt-1">
                Model: {data.model}
            </div>
            <div className="flex-1 pt-1">
                Price: {data.price}
            </div>
            <div className="flex-1 pt-1">
                Description: {data.description}
            </div>
            <div className="flex-1 pt-1">
                Vehicle Type: {data.vehicle_subcategory.name}
            </div>
        </div>
    );
}
