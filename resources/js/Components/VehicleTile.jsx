import React, { useState } from 'react';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { useForm, usePage } from '@inertiajs/react';
import Modal from '@/Components/Modal';
import SecondaryButton from '@/Components/SecondaryButton';
import Vehicle from "@/Components/Vehicle.jsx";

dayjs.extend(relativeTime);

export default function VehicleTile({vehicle}) {

    const { auth } = usePage().props;
    const [modalOpen, toggleModalVisibility] = useState(false);

    const setModalVisibility = (value) => {
        toggleModalVisibility(value);
    };

    return (
        <div className="p-6 flex space-x-2">
            <SecondaryButton className="hover:bg-slate-50" onClick={() =>setModalVisibility(true)}>{vehicle.name}</SecondaryButton>
            <Modal show={modalOpen}>
                <div className="flex-1 flex flex-col">
                    <Vehicle data={vehicle} ></Vehicle>
                </div>
                <div className="flex-1 flex flex-col items-center pb-3">
                    <SecondaryButton onClick={() =>setModalVisibility(false)}>Close</SecondaryButton>
                </div>
            </Modal>
        </div>
    );
}
