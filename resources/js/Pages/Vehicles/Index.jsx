import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Vehicle from "@/Components/Vehicle.jsx";
import {Head, useForm} from '@inertiajs/react';
import SecondaryButton from "@/Components/SecondaryButton.jsx";
import {useState} from "react";
import VehicleTile from "@/Components/VehicleTile.jsx";
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import Pagination from '@/Components/Pagination';

export default function Index({ category, subCats, count, vehicles }) {

    const [subCat,setSubCat] = useState(0);
    const [order,setOrder] = useState('');
    const [query, setQuery] = useState("");

    const updateOrderPrice = (e) => {
        setOrder('Price '+e);
        let sortedProducts;
        if(e === 'asc') {
            sortedProducts = vehicles.data.sort((a, b) => {
                return parseInt(a.price) - parseInt(b.price);
            })
        }else{
            sortedProducts = vehicles.data.sort((a, b) => {
                return parseInt(b.price) - parseInt(a.price);
            })
        }
        vehicles.data = sortedProducts;
    }

    const updateOrderName = (e) => {
        setOrder('Name '+e);
        let sortedProducts;
        if(e === 'asc') {
            sortedProducts = vehicles.data.sort((a, b) => {
                return a.name > b.name;
            })
        }else{
            sortedProducts = vehicles.data.sort((a, b) => {
                return a.name < b.name;
            })
        }
        vehicles.data = sortedProducts;
    }

    return (
        <AuthenticatedLayout
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">{category}</h2>}
        >
            <Head title={category} />
            <div className="py-12 ">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="mt-6 bg-white shadow-sm rounded-lg divide-y">
                        <div>
                            <InputLabel htmlFor="search" value="Search" />
                            <input name="search" placeholder="Search vehicle name" onChange={event => setQuery(event.target.value)} />
                        </div>
                        <div>
                        Filters
                        </div>
                        <div className="flex space-x-2">
                        <SecondaryButton className="hover:bg-slate-50" onClick={() =>setSubCat(0)}>All {category}</SecondaryButton>
                        {subCats.map(subC =>
                            <SecondaryButton className="hover:bg-slate-50" onClick={() =>setSubCat(subC.id)}>{subC.name}</SecondaryButton>
                        )}
                        </div>
                        <div>
                            Order By: {order}
                        </div>
                        <div className="flex space-x-2">
                            <SecondaryButton className="hover:bg-slate-50" onClick={() =>updateOrderPrice('asc')}>Price Asc</SecondaryButton>
                            <SecondaryButton className="hover:bg-slate-50" onClick={() =>updateOrderPrice('desc')}>Price Desc</SecondaryButton>
                            <SecondaryButton className="hover:bg-slate-50" onClick={() =>updateOrderName('asc')}>Name Asc</SecondaryButton>
                            <SecondaryButton className="hover:bg-slate-50" onClick={() =>updateOrderName('desc')}>Name Desc</SecondaryButton>
                        </div>
                    </div>

                    <div className="mt-6 bg-white shadow-sm rounded-lg divide-y grid grid-cols-4 gap-4">
                        {vehicles.data.filter(vehicle => {
                            if (query === '') {
                                return vehicle;
                            } else if (vehicle.name.toLowerCase().includes(query.toLowerCase())) {
                                return vehicle;
                            }
                        }).map(vehicle => {
                            if (subCat == 0 || subCat == vehicle.vehicle_subcategory_id)
                                return <VehicleTile className="hover:bg-slate-50" key={vehicle.id} vehicle={vehicle}/>
                            }
                        )}
                    </div>
                    <Pagination class="mt-6" links={vehicles.links} />
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
