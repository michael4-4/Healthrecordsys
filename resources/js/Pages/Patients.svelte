<script>
    import { onMount } from "svelte";
    import Layout from "./Layout.svelte";
    export let patients;
    export let startNumber;
    export let barangays;
    // Define the selected filter
    let selectedFilter = "";

    // Define a function to handle filter change
    function handleFilterChange(event) {
        selectedFilter = event.target.value;
        // You can perform any additional actions here, such as filtering the patient records
    }

    onMount(()=>{
        console.log(patients);
    })
</script>

<Layout>
    <main>
        <div class="container1">
            <!-- Filter and search form -->
            <div class="search-filter-container">
                <form action="" method="GET" class="search-form">
                    <div class="search-container">
                        <input
                            type="text"
                            name="search_query"
                            placeholder="Search..."
                            class="search-input"
                        />
                        <button type="submit" class="search-button"
                            ><i class="fas fa-search"></i></button
                        >
                    </div>
                </form>

                <!-- Filter form -->
                <form
                    action=""
                    method="GET"
                    class="filter-form"
                    on:change={handleFilterChange}
                >
                    <label for="filter">Filter by Barangay:</label>
                    <select
                        name="filter"
                        id="filter"
                        bind:value={selectedFilter}
                    >
                        <option disabled selected>Select</option>
                        <option value="Show All">Show All</option>
                        <option value="Acnam">Acnam</option>
                        <option value="Barikir">Barikir</option>
                        <option value="Barangobong">Barangobong</option>
                        <option value="Bugayong">Bugayong</option>
                        <option value="Caray">Caray</option>
                        <option value="Cabitauran">Cabitauran</option>
                        <option value="Garnaden">Garnaden</option>
                        <option value="Naguilian">Naguilian</option>
                        <option value="Poblacion">Poblacion</option>
                        <option value="Sto. Nino">Sto. Nino</option>
                        <option value="Uguis">Uguis</option>
                    </select>
                </form>
            </div>

            <!-- Patient records table -->
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 5%">Number</th>
                        <th style="width: 8%">Last Name</th>
                        <th style="width: 8%">First Name</th>
                        <th style="width: 10%">Address</th>
                        <th style="width: 3%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {#if patients?.data?.length}
                        {#each patients?.data as patient, index}
                            {#if !selectedFilter || patient.barangay === selectedFilter || selectedFilter === "Show All"}
                                <tr>
                                    <td>{startNumber + index}</td>
                                    <td>{patient.last_name}</td>
                                    <td>{patient.first_name}</td>
                                    <td>{patient.barangay}</td>
                                    <td>
                                        <a
                                            href={`patient.view/${patient.patient_id}`}
                                            class="view-button"
                                            title="View"
                                            ><i class="fas fa-eye"></i></a
                                        >
                                        <a
                                            href={`patient.edit/${patient.patient_id}`}
                                            class="edit-button"
                                            title="Edit"
                                            ><i class="fas fa-edit"></i></a
                                        >
                                    </td>
                                </tr>
                            {/if}
                        {:else}
                            <tr>
                                <td
                                    colspan="5"
                                    style="text-align:center; font-style: oblique;"
                                    >No patient records found</td
                                >
                            </tr>
                        {/each}
                    {/if}
                </tbody>
            </table>
        </div>
    </main>
</Layout>
