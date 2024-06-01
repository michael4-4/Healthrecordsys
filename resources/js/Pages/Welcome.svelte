<script>
    export let data;
  </script>
  
  <main>
    <h1>{data.message}</h1>
    <ul>
      {#each data.items as item}
        <li>{item}</li>
      {/each}
    </ul>
  </main>
  
  <style>
    /* Add your styles here */
  </style>